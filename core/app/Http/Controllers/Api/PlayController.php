<?php

namespace App\Http\Controllers\Api;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\GameLog;
use App\Models\GuessBonus;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PlayController extends Controller {
    public function playGame($alias) {
        $game = Game::active()->where('alias', $alias)->first();
        if (!$game) {
            $notify[] = 'Game not found';
            return response()->json([
                'remark'  => 'not_found',
                'status'  => 'error',
                'message' => ['error' => $notify],
            ]);
        }

        $pokerImg           = null;
        $image_path         = null;
        $winPercent         = [];
        $winChance          = null;
        $cardFindingImgName = [];
        $cardFindingImgPath = null;

        $gesBon = [];

        if ($game->alias == 'number_guess') {
            $gesBon = GuessBonus::where('alias', $game->alias)->get();
            foreach ($gesBon as $bon) {
                array_push($winPercent, $bon->percent);
                $winChance++;
            };
        }

        if ($game->alias == 'poker') {
            $gesBon = GuessBonus::where('alias', $game->alias)
                ->orderBy('chance', 'asc')
                ->pluck('percent')
                ->toArray();

            $pokerImg = [
                'royal_flush.png', 'straight_flush.png', 'four_kind.png', 'full_house.png', 'flash.png', 'straight.png',
                'three_kind.png', 'two_pair.png', 'one_pair.png', 'high_card.png',
            ];

            $image_path = asset(activeTemplate(true) . 'images/poker');
        }

        if ($game->alias == 'card_finding') {
            $cardFindingImgPath = asset(activeTemplate(true) . 'images/play/cards');
            for ($i = 5; $i < 54; $i = $i + 5) {
                $cardFindingImgName[] = sprintf("%02d", $i);
            }
        }

        $notify[] = $game->name . ' game data';
        return response()->json([
            'remark'  => 'game_data',
            'status'  => 'success',
            'message' => ['success' => $notify],
            'data'    => [
                'game'               => $game,
                'userBalance'        => showAmount(auth()->user()->balance, currencyFormat: false),
                'image_path'         => $image_path,
                'winChance'          => $winChance,
                'winPercent'         => $winPercent,
                'gesBon'             => $gesBon,
                'pokerImg'           => $pokerImg,
                'shortDesc'          => ($game->alias == 'blackjack' ? $game->short_desc : null),
                'cardFindingImgName' => $cardFindingImgName,
                'cardFindingImgPath' => $cardFindingImgPath,
            ],
        ]);
    }

    public function investGame(Request $request, $alias) {
        $game = Game::active()->where('alias', $alias)->first();
        if (!$game) {
            $notify[] = 'Game not found';
            return response()->json([
                'remark'  => 'not_found',
                'status'  => 'error',
                'message' => ['error' => $notify],
            ]);
        }

        $aliasName  = str_replace('_', ' ', $alias);
        $methodName = 'play' . str_replace(' ', '', ucwords($aliasName));
        return $this->$methodName($game, $request);
    }

    public function gameEnd(Request $request, $alias) {
        $game = Game::active()->where('alias', $alias)->first();
        if (!$game) {
            $notify[] = 'Game not found';
            return response()->json([
                'remark'  => 'not_found',
                'status'  => 'error',
                'message' => ['error' => $notify],
            ]);
        }
        $aliasName  = str_replace('_', ' ', $alias);
        $methodName = 'gameEnd' . str_replace(' ', '', ucwords($aliasName));
        return $this->$methodName($game, $request);
    }

    // ...................................Same Game Loop Start ..........................................
    public function playHeadTail($game, $request) {
        $validator = $this->investValidation($request, 'head,tail');

        if ($validator->fails()) {
            return response()->json([
                'remark'  => 'validation_error',
                'status'  => 'error',
                'message' => ['error' => $validator->errors()->all()],
            ]);
        }

        $user = auth()->user();

        $fallback = $this->fallback($request, $user, $game);

        if (@$fallback['error']) {
            return response()->json([
                'remark'  => 'fallback_error',
                'status'  => 'error',
                'message' => $fallback,
            ]);
        }

        $random = mt_rand(0, 100);

        if ($random <= $game->probable_win) {
            $win    = Status::WIN;
            $result = $request->choose;
        } else {
            $win    = Status::LOSS;
            $result = $request->choose == 'head' ? 'tail' : 'head';
        }

        $invest = $this->invest($user, $request, $game, $result, $win);

        $res['game_log'] = $invest['game_log'];
        $res['balance']  = $user->balance;

        $notify[] = $game->name . ' investment data';
        return response()->json([
            'remark'  => 'investment_data',
            'status'  => 'success',
            'message' => ['success' => $notify],
            'data'    => $res,
        ]);
    }

    public function playRockPaperScissors($game, $request) {

        $validator = $this->investValidation($request, 'rock,paper,scissors');

        if ($validator->fails()) {
            return response()->json([
                'remark'  => 'validation_error',
                'status'  => 'error',
                'message' => ['error' => $validator->errors()->all()],
            ]);
        }

        $user = auth()->user();

        $fallback = $this->fallback($request, $user, $game);

        if (@$fallback['error']) {
            return response()->json([
                'remark'  => 'fallback_error',
                'status'  => 'error',
                'message' => $fallback,
            ]);
        }

        $userChoose = $request->choose;
        $random     = mt_rand(0, 100);

        if ($random <= $game->probable_win) {
            $win = Status::WIN;

            if ($userChoose == 'rock') {
                $result = 'scissors';
            }

            if ($userChoose == 'paper') {
                $result = 'rock';
            }

            if ($userChoose == 'scissors') {
                $result = 'paper';
            }
        } else {
            $win = Status::LOSS;

            if ($userChoose == 'rock') {
                $result = 'paper';
            }

            if ($userChoose == 'paper') {
                $result = 'scissors';
            }

            if ($userChoose == 'scissors') {
                $result = 'rock';
            }
        }

        $invest = $this->invest($user, $request, $game, $result, $win);

        $res['game_log'] = $invest['game_log'];
        $res['balance']  = showAmount($user->balance, currencyFormat: false);

        $notify[] = $game->name . ' investment data';
        return response()->json([
            'remark'  => 'investment_data',
            'status'  => 'success',
            'message' => ['success' => $notify],
            'data'    => $res,
        ]);
    }

    public function playSpinWheel($game, $request) {
        $validator = $this->investValidation($request, 'red,blue');

        if ($validator->fails()) {
            return response()->json([
                'remark'  => 'validation_error',
                'status'  => 'error',
                'message' => ['error' => $validator->errors()->all()],
            ]);
        }

        $user     = auth()->user();
        $fallback = $this->fallback($request, $user, $game);

        if (@$fallback['error']) {
            return response()->json([
                'remark'  => 'fallback_error',
                'status'  => 'error',
                'message' => $fallback,
            ]);
        }

        $random = mt_rand(0, 100);

        if ($random <= $game->probable_win) {
            $win    = Status::WIN;
            $result = $request->choose;
        } else {
            $win    = Status::LOSS;
            $result = $request->choose == 'blue' ? 'red' : 'blue';
        }

        $invest = $this->invest($user, $request, $game, $result, $win);

        $res['game_log'] = $invest['game_log'];
        $res['balance']  = $user->balance;

        $res['result'] = $result;

        $notify[] = $game->name . ' investment data';
        return response()->json([
            'remark'  => 'investment_data',
            'status'  => 'success',
            'message' => ['success' => $notify],
            'data'    => $res,
        ]);
    }

    public function playNumberGuess($game, $request) {
        $validator = Validator::make($request->all(), [
            'invest' => 'required|numeric|gt:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'remark'  => 'validation_error',
                'status'  => 'error',
                'message' => ['error' => $validator->errors()->all()],
            ]);
        }

        $user = auth()->user();

        $fallback = $this->fallback($request, $user, $game);

        if (@$fallback['error']) {
            return response()->json([
                'remark'  => 'fallback_error',
                'status'  => 'error',
                'message' => $fallback,
            ]);
        }

        $num = mt_rand(1, 100);

        $invest                     = $this->invest($user, $request, $game, $num, 0);
        $invest['game_log']->result = null;

        $res['game_log'] = $invest['game_log'];
        $res['balance']  = $user->balance;

        $bonusPercent = null;

        if ($game->alias == 'number_guess') {
            $percent = 0;
            $bonus   = GuessBonus::where('alias', $game->alias)->where('chance', 1)->first();
            if ($bonus) {
                $percent = $bonus->percent;
            }
            $bonusPercent = $percent . '%';
        }

        $res['bonusPercent '] = $bonusPercent;

        $notify[] = $game->name . ' investment data';
        return response()->json([
            'remark'  => 'investment_data',
            'status'  => 'success',
            'message' => ['success' => $notify],
            'data'    => $res,
        ]);
    }

    public function playDiceRolling($game, $request) {

        $validator = $this->investValidation($request, '1,2,3,4,5,6');

        if ($validator->fails()) {
            return response()->json([
                'remark'  => 'validation_error',
                'status'  => 'error',
                'message' => ['error' => $validator->errors()->all()],
            ]);
        }

        $user = auth()->user();

        $fallback = $this->fallback($request, $user, $game);

        if (@$fallback['error']) {
            return response()->json([
                'remark'  => 'fallback_error',
                'status'  => 'error',
                'message' => $fallback,
            ]);
        }

        $random = mt_rand(0, 100);

        if ($random <= $game->probable_win) {
            $win    = Status::WIN;
            $result = $request->choose;
        } else {
            $win = Status::LOSS;

            for ($i = 0; $i < 100; $i++) {
                $randWin = rand(1, 6);

                if ($randWin != $request->choose) {
                    $result = $randWin;
                    break;
                }
            }
        }

        $invest = $this->invest($user, $request, $game, $result, $win);

        $res['game_log'] = $invest['game_log'];
        $res['balance']  = $user->balance;

        $res['result'] = $result;

        $notify[] = $game->name . ' investment data';
        return response()->json([
            'remark'  => 'investment_data',
            'status'  => 'success',
            'message' => ['success' => $notify],
            'data'    => $res,
        ]);
    }

    public function playCardFinding($game, $request) {

        $validator = $this->investValidation($request, 'black,red');

        if ($validator->fails()) {
            return response()->json([
                'remark'  => 'validation_error',
                'status'  => 'error',
                'message' => ['error' => $validator->errors()->all()],
            ]);
        }

        $user = auth()->user();

        $fallback = $this->fallback($request, $user, $game);

        if (@$fallback['error']) {
            return response()->json([
                'remark'  => 'fallback_error',
                'status'  => 'error',
                'message' => $fallback,
            ]);
        }

        $random = mt_rand(0, 100);

        if ($random <= $game->probable_win) {
            $win    = Status::WIN;
            $result = $request->choose;
        } else {
            $win    = Status::LOSS;
            $result = $request->choose == 'black' ? 'red' : 'black';
        }

        $invest = $this->invest($user, $request, $game, $result, $win);

        $res['game_log'] = $invest['game_log'];
        $res['balance']  = $user->balance;

        $notify[] = $game->name . ' investment data';
        return response()->json([
            'remark'  => 'investment_data',
            'status'  => 'success',
            'message' => ['success' => $notify],
            'data'    => $res,
        ]);
    }

    public function playNumberPool($game, $request) {
        $validator = $this->investValidation($request, '1,2,3,4,5,6,7,8');

        if ($validator->fails()) {
            return response()->json([
                'remark'  => 'validation_error',
                'status'  => 'error',
                'message' => ['error' => $validator->errors()->all()],
            ]);
        }

        $user = auth()->user();

        $fallback = $this->fallback($request, $user, $game);

        if (@$fallback['error']) {
            return response()->json([
                'remark'  => 'fallback_error',
                'status'  => 'error',
                'message' => $fallback,
            ]);
        }

        $random = mt_rand(0, 100);
        $result = 8;

        if ($random <= $game->probable_win) {
            $win    = Status::ENABLE;
            $result = $request->choose;
        } else {
            $win = Status::DISABLE;

            for ($i = 0; $i < 100; $i++) {
                $randWin = rand(1, 8);

                if ($randWin != $request->choose) {
                    $result = $randWin;
                    break;
                }
            }
        }

        $invest = $this->invest($user, $request, $game, $result, $win);

        $res['game_log'] = $invest['game_log'];
        $res['balance']  = $user->balance;

        $res['win'] = $win;

        $notify[] = $game->name . ' investment data';
        return response()->json([
            'remark'  => 'investment_data',
            'status'  => 'success',
            'message' => ['success' => $notify],
            'data'    => $res,
        ]);
    }

    public function PlayNumberSlot($game, $request) {
        $validator = $this->investValidation($request, '0,1,2,3,4,5,6,7,8,9');

        if ($validator->fails()) {
            return response()->json([
                'remark'  => 'validation_error',
                'status'  => 'error',
                'message' => ['error' => $validator->errors()->all()],
            ]);
        }

        $user = auth()->user();

        $fallback = $this->fallback($request, $user, $game);

        if (@$fallback['error']) {
            return response()->json([
                'remark'  => 'fallback_error',
                'status'  => 'error',
                'message' => $fallback,
            ]);
        }

        $random = mt_rand(1, 100);

        if ($game->probable_win[0] > $random) {
            $result = numberSlotResult(0, $request->choose);
            $win    = 0;
        } else if ($game->probable_win[0] + $game->probable_win[1] > $random) {
            $result = numberSlotResult(1, $request->choose);
            $win    = Status::WIN;
        } else if ($game->probable_win[0] + $game->probable_win[1] + $game->probable_win[2] > $random) {
            $result = numberSlotResult(2, $request->choose);
            $win    = 2;
        } else {
            $result = numberSlotResult(3, $request->choose);
            $win    = 3;
        }

        $invest = $this->invest($user, $request, $game, $result, $win);

        $res['game_log'] = $invest['game_log'];
        $res['number']   = $result;
        $res['win']      = $win;
        $res['balance']  = $user->balance;

        $notify[] = $game->name . ' investment data';
        return response()->json([
            'remark'  => 'investment_data',
            'status'  => 'success',
            'message' => ['success' => $notify],
            'data'    => $res,
        ]);
    }
    // ................................... Same Game Loop End ..........................................

    // ................................... Roulette ..........................................
    public function rouletteSubmit(Request $request) {
        $validator = Validator::make($request->all(), [
            'invest' => 'required|numeric|gt:0',
            'choose' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'remark'  => 'validation_error',
                'status'  => 'error',
                'message' => ['error' => $validator->errors()->all()],
            ]);
        }
        $game = Game::where('id', 9)->first();
        if (!$game) {
            $notify[] = 'Game not found';
            return response()->json([
                'remark'  => 'not_found',
                'status'  => 'error',
                'message' => ['error' => $notify],
            ]);
        }
        if ($request->invest < $game->min_limit) {
            $notify[] = 'Minimum invest limit is ' . showAmount($game->min_limit, currencyFormat: false);
            return response()->json([
                'remark'  => 'min_limit',
                'status'  => 'error',
                'message' => ['error' => $notify],
            ]);
        }

        if ($request->invest > $game->max_limit) {
            $notify[] = 'Maximum invest limit is ' . showAmount($game->max_limit, currencyFormat: false);
            return response()->json([
                'remark'  => 'max_limit',
                'status'  => 'error',
                'message' => ['error' => $notify],
            ]);
        }

        $amount = $request->invest;
        $user   = auth()->user();
        if ($amount > $user->balance) {
            $notify[] = 'Insufficient balance';
            return response()->json([
                'remark'  => 'insufficient_balance',
                'status'  => 'error',
                'message' => ['error' => $notify],
            ]);
        }

        $running = GameLog::where('user_id', $user->id)->where('game_id', 9)->where('status', Status::GAME_RUNNING)->first();
        if ($running) {
            $notify[] = 'You have an unfinished game. Please wait';
            return response()->json([
                'remark'  => 'unfinished_game',
                'status'  => 'error',
                'message' => ['error' => $notify],
            ]);
        }

        if ($request->choose == '1_12') {
            $numbers = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
        } else if ($request->choose == '13_24') {
            $numbers = [13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24];
        } else if ($request->choose == '25_36') {
            $numbers = [25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36];
        } else if ($request->choose == '1_18') {
            $numbers = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18];
        } else if ($request->choose == '19_36') {
            $numbers = [19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36];
        } else if ($request->choose == 'even') {
            $numbers = [2, 4, 6, 8, 10, 12, 14, 16, 18, 20, 22, 24, 26, 28, 30, 32, 34, 36];
        } else if ($request->choose == 'odd') {
            $numbers = [1, 3, 5, 7, 9, 11, 13, 15, 17, 19, 21, 23, 25, 27, 29, 31, 33, 35];
        } else if ($request->choose == 'red') {
            $numbers = [1, 3, 5, 7, 9, 12, 14, 16, 18, 19, 21, 23, 25, 27, 30, 32, 34, 36];
        } else if ($request->choose == 'black') {
            $numbers = [2, 4, 6, 8, 10, 11, 13, 15, 17, 20, 22, 24, 26, 28, 29, 31, 33, 35];
        } else if ($request->choose == '2_1_1') {
            $numbers = [3, 6, 9, 12, 15, 18, 21, 24, 27, 30, 33, 36];
        } else if ($request->choose == '2_1_2') {
            $numbers = [2, 5, 8, 11, 14, 17, 20, 23, 26, 29, 32, 35];
        } else if ($request->choose == '2_1_3') {
            $numbers = [1, 4, 7, 10, 13, 16, 19, 22, 25, 28, 31, 34];
        } else {
            $numbers = [$request->choose];
        }

        $random = rand(1, 36);
        if (in_array($random, $numbers)) {
            $win = Status::WIN;
        } else {
            $win = Status::LOSS;
        }
        $winAmount = $request->invest * (36 / count($numbers));
        $invest    = $this->invest($user, $request, $game, $random, $win, $winAmount);

        $res['game_log'] = $invest['game_log'];
        $res['balance']  = $user->balance;

        $notify[] = $game->name . ' investment data';
        return response()->json([
            'remark'  => 'investment_data',
            'status'  => 'success',
            'message' => ['success' => $notify],
            'data'    => $res,
        ]);
    }

    public function rouletteResult(Request $request) {
        $validator = Validator::make($request->all(), [
            'gameLog_id' => 'required|integer',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'remark'  => 'validation_error',
                'status'  => 'error',
                'message' => ['error' => $validator->errors()->all()],
            ]);
        }
        $user    = auth()->user();
        $gameLog = GameLog::where('user_id', $user->id)->where('id', $request->gameLog_id)->where('game_id', 9)->where('status', 0)->first();
        if (!$gameLog) {
            $notify[] = 'Game not found';
            return response()->json([
                'remark'  => 'not_found',
                'status'  => 'error',
                'message' => ['error' => $notify],
            ]);
        }

        $notification = 'Oops! You Lost!';
        $type         = 'danger';
        if ($gameLog->win_status == Status::WIN) {
            $user->balance += $gameLog->win_amo;
            $user->save();

            $transaction               = new Transaction();
            $transaction->user_id      = $user->id;
            $transaction->amount       = $gameLog->win_amo;
            $transaction->charge       = 0;
            $transaction->trx_type     = '+';
            $transaction->details      = 'Win bonus of ' . @$gameLog->game->name;
            $transaction->remark       = 'Win_Bonus';
            $transaction->trx          = getTrx();
            $transaction->post_balance = $user->balance;
            $transaction->save();
            $notification = 'Yahoo! You Win!';
            $type         = 'success';
        }
        $gameLog->status = Status::GAME_FINISHED;
        $gameLog->save();

        $notify[] = 'Roulette game result';
        return response()->json([
            'remark'  => 'game_result',
            'status'  => 'success',
            'message' => ['success' => $notify],
            'data'    => [
                'message'       => $notification,
                'type'          => $type,
                'result'        => $gameLog->result,
                'user_selected' => $gameLog->user_select,
                'balance'       => showAmount($user->balance, currencyFormat: false),
            ],
        ]);
    }

    // ................................... Keno ..........................................
    public function kenoSubmit(Request $request) {
        $request->choose = json_decode($request->choose);
        $validator       = Validator::make($request->all(), [
            'invest' => 'required|numeric|gt:0',
            'choose' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'remark'  => 'validation_error',
                'status'  => 'error',
                'type'    => gettype($request->choose),
                'message' => ['error' => $validator->errors()->all()],
            ]);
        }

        $user = auth()->user();

        $game = Game::active()->where('alias', 'keno')->first();
        if (!$game) {
            $notify[] = 'Game not found';
            return response()->json([
                'remark'  => 'not_found',
                'status'  => 'error',
                'message' => ['error' => $notify],
            ]);
        }

        $fallback = $this->fallback($request, $user, $game);

        if (@$fallback['error']) {
            return response()->json([
                'remark'  => 'fallback_error',
                'status'  => 'error',
                'message' => $fallback,
            ]);
        }

        $random = mt_rand(0, 100);

        if ($random <= $game->probable_win) {
            $win    = Status::WIN;
            $result = $request->choose;
        } else {
            $win    = Status::LOSS;
            $result = $request->choose;
        }

        $winAmount       = 0;
        $maxSelectNumber = @$game->level->max_select_number;
        if ($win) {
            $getRandNumber    = rand(4, @$maxSelectNumber);
            $getNewSlotNumber = array_slice($result, 0, $getRandNumber, true);
            $matchNumber      = $getNewSlotNumber;

            while (count($getNewSlotNumber) < $maxSelectNumber) {
                $randomValue = rand(1, 80);
                if (!in_array($randomValue, $getNewSlotNumber) && !in_array($randomValue, $result)) {
                    array_push($getNewSlotNumber, (string) $randomValue);
                }
            }

            $result = $getNewSlotNumber;

            $commission = array_reduce($game->level->levels, function ($carry, $element) use ($getRandNumber) {
                if ((int) $element->level === $getRandNumber) {
                    $carry = $element->percent;
                }
                return $carry;
            });

            $winAmount = $request->invest + ($request->invest * $commission / 100);
        } else {
            $loseSlotNumber = [];
            while (count($loseSlotNumber) < $maxSelectNumber) {
                $randomValue = rand(1, 80);
                if (!in_array($randomValue, $loseSlotNumber) && !in_array($randomValue, $result)) {
                    array_push($loseSlotNumber, (string) $randomValue);
                }
            }
            $result      = $loseSlotNumber;
            $matchNumber = [];
        }

        $invest              = $this->invest($user, $request, $game, $result, $win, $winAmount);
        $res['game_log']     = $invest['game_log'];
        $res['user_select']  = json_decode($invest['game_log']->user_select);
        $res['match_number'] = $matchNumber;
        $res['balance']      = showAmount($user->balance, currencyFormat: false);

        $notify[] = $game->name . ' investment data';
        return response()->json([
            'remark'  => 'investment_data',
            'status'  => 'success',
            'message' => ['success' => $notify],
            'data'    => $res,
        ]);
    }

    public function kenoUpdate(Request $request) {
        $user    = auth()->user();
        $gameLog = GameLog::where('user_id', $user->id)->where('id', $request->gameLog_id)->where('status', 0)->first();
        if (!$gameLog) {
            $notify[] = 'Game logs not found';
            return response()->json([
                'remark'  => 'not_found',
                'status'  => 'error',
                'message' => ['error' => $notify],
            ]);
        }
        $gameLog->status = Status::GAME_FINISHED;
        $gameLog->save();

        if ($gameLog->win_status == Status::WIN) {
            $user->balance += $gameLog->win_amo;
            $user->save();

            $transaction               = new Transaction();
            $transaction->user_id      = $user->id;
            $transaction->amount       = $gameLog->win_amo;
            $transaction->charge       = 0;
            $transaction->trx_type     = '+';
            $transaction->details      = 'Win bonus of ' . @$gameLog->game->name;
            $transaction->remark       = 'Win_Bonus';
            $transaction->trx          = getTrx();
            $transaction->post_balance = $user->balance;
            $transaction->save();
        }

        $result = json_decode($gameLog->result);
        foreach ($result as $key => $value) {
            $result[$key] = strval($value);
        }

        $notify[] = 'Keno game result';
        return response()->json([
            'remark'  => 'game_result',
            'status'  => 'success',
            'message' => ['success' => $notify],
            'data'    => [
                'win'           => $gameLog->win_status,
                'result'        => $result,
                'user_selected' => $gameLog->user_select,
                'balance'       => showAmount($user->balance, currencyFormat: false),
            ],
        ]);
    }

    // ............... Black Jack ....................
    public function playBlackjack($game, $request) {
        $validator = Validator::make($request->all(), [
            'invest' => "required|numeric|gte:$game->min_limit",
        ]);
        if ($validator->fails()) {
            return response()->json([
                'remark'  => 'validation_error',
                'status'  => 'error',
                'message' => ['error' => $validator->errors()->all()],
            ]);
        }
        $user     = auth()->user();
        $fallback = $this->fallback($request, $user, $game);

        if (@$fallback['error']) {
            return response()->json([
                'remark'  => 'fallback_error',
                'status'  => 'error',
                'message' => $fallback,
            ]);
        }

        $values = ["A", "2", "3", "4", "5", "6", "7", "8", "9", "10", "J", "Q", "K"];
        $types  = ["C", "D", "H", "S"];
        $deck   = [];
        for ($i = 0; $i < count($types); $i++) {
            for ($j = 0; $j < count($values); $j++) {
                $deck[] = $values[$j] . "-" . $types[$i];
            }
        }
        for ($a = 0; $a < count($deck); $a++) {
            $randValue = ((float) rand() / (float) getrandmax()) * count($deck);
            $b         = (int) floor($randValue);
            $temp      = $deck[$a];
            $deck[$a]  = $deck[$b];
            $deck[$b]  = $temp;
        }

        $dealerSum = 0;
        $userSum   = 0;

        $dealerAceCount = 0;
        $userAceCount   = 0;

        $hidden = array_pop($deck);
        $dealerSum += $this->getValue($hidden);
        $dealerAceCount += $this->checkAce($hidden);

        while ($dealerSum < 17) {
            $dealercard      = array_pop($deck);
            $dealerCardImg[] = $dealercard;
            $dealerSum       = $dealerSum + $this->getValue($dealercard);
            $dealerAceCount += $this->checkAce($dealercard);
        }

        for ($m = 0; $m < 2; $m++) {
            $card      = array_pop($deck);
            $cardImg[] = $card;
            $userSum += $this->getValue($card);
            $userAceCount += $this->checkAce($card);
        }

        $user->balance -= $request->invest;
        $user->save();

        $transaction               = new Transaction();
        $transaction->user_id      = $user->id;
        $transaction->amount       = $request->invest;
        $transaction->charge       = 0;
        $transaction->trx_type     = '-';
        $transaction->details      = 'Invest to ' . $game->name;
        $transaction->remark       = 'invest';
        $transaction->trx          = getTrx();
        $transaction->post_balance = $user->balance;
        $transaction->save();

        $dealerResult = array_merge([$hidden], $dealerCardImg);

        $gameLog                 = new GameLog();
        $gameLog->user_id        = $user->id;
        $gameLog->game_id        = $game->id;
        $gameLog->user_select    = json_encode($cardImg);
        $gameLog->result         = json_encode($dealerResult);
        $gameLog->shuffled_cards = json_encode($deck);
        $gameLog->status         = 0;
        $gameLog->win_status     = 0;
        $gameLog->invest         = $request->invest;
        $gameLog->save();

        // return $deck;

        $notify[] = 'Black Jack game invest';
        return response()->json([
            'remark'  => 'game_invest',
            'status'  => 'success',
            'message' => ['success' => $notify],
            'data'    => [
                'dealerSum'      => $dealerSum,
                'dealerAceCount' => $dealerAceCount,
                'userSum'        => $userSum,
                'userAceCount'   => $userAceCount,
                'dealerCardImg'  => $dealerCardImg,
                'cardImg'        => $cardImg,
                'game_log'       => $gameLog,
                'balance'        => showAmount($user->balance, currencyFormat: false),
                'card'           => $deck,
                'image_path'     => asset(activeTemplate(true) . '/images/cards/'),

            ],
        ]);
    }

    protected function getValue($card) {
        $data = explode("-", $card);

        $value = trim($data[0]);

        if ($value == 'A' || $value == 'K' || $value == 'Q' || $value == 'J') {

            if ($value == "A") {
                return 11;
            }
            return 10;
        }
        return (int) $value;
    }

    protected function checkAce($card) {
        if ($card[0] == "A") {
            return 1;
        }
        return 0;
    }

    public function blackjackHit(Request $request) {

        $gameLog = GameLog::where('status', 0)->where('id', $request->game_log_id)->where('user_id', auth()->id())->first();
        if (!$gameLog) {
            $notify[] = 'Game not found';
            return response()->json([
                'remark'  => 'not_found',
                'status'  => 'error',
                'message' => ['error' => $notify],
            ]);
        }

        $userSum           = 0;
        $userAceCount      = 0;
        $user_select_cards = json_decode($gameLog->user_select);
        $length            = count($user_select_cards);

        for ($m = 0; $m < $length; $m++) {
            $card      = array_pop($user_select_cards);
            $cardImg[] = $card;
            $userSum += $this->getValue($card);
            $userAceCount += $this->checkAce($card);
        }

        $reduceAce = $this->reduceAce($userSum, $userAceCount);

        if ($reduceAce > 21) {
            $notify[] = 'You can\'t hit more';
            return response()->json([
                'remark'  => 'game_error',
                'status'  => 'error',
                'message' => ['error' => $notify],
            ]);
        }

        $deck = json_decode($gameLog->shuffled_cards);

        $card2      = array_pop($deck);
        $cardImg2[] = $card2;
        $userSum    = $reduceAce + $this->getValue($card2);
        $userAceCount += $this->checkAce($card2);
        if ($this->checkAce($card2)) {
            $userSum = $this->reduceAce($userSum, $userAceCount);
        }

        $oldCard                 = json_decode($gameLog->user_select);
        $newCard                 = array_merge($oldCard, [$card2]);
        $gameLog->user_select    = json_encode($newCard);
        $gameLog->shuffled_cards = json_encode($deck);
        $gameLog->save();

        $notify[] = 'Black Jack game hit';
        return response()->json([
            'remark'  => 'game_hit_result',
            'status'  => 'success',
            'message' => ['success' => $notify],
            'data'    => [
                'userSum'      => $userSum,
                'userAceCount' => $userAceCount,
                'cardImg'      => $cardImg2,
                'game_log'     => $gameLog,
                'card'         => $deck,
                'balance'      => showAmount(auth()->user()->balance, currencyFormat: false),
            ],
        ]);
    }

    public function blackjackStay(Request $request) {
        $gameLog = GameLog::where('status', 0)->where('id', $request->game_log_id)->where('user_id', auth()->id())->first();
        if (!$gameLog) {
            $notify[] = 'Game logs not found';
            return response()->json([
                'remark'  => 'not_found',
                'status'  => 'error',
                'message' => ['error' => $notify],
            ]);
        }

        $userSelectCard = json_decode($gameLog->user_select);
        $userCardSum    = 0;
        foreach ($userSelectCard as $userCard) {
            $userCardSum += $this->getValue($userCard);
        }

        $dealerSelectCard = json_decode($gameLog->result);
        $dealerCardSum    = 0;
        foreach ($dealerSelectCard as $dealerCard) {
            $dealerCardSum += $this->getValue($dealerCard);
        }

        $userAceCount      = 0;
        $user_select_cards = json_decode($gameLog->user_select);
        $length            = count($user_select_cards);

        for ($m = 0; $m < $length; $m++) {
            $user_card = array_pop($user_select_cards);
            $userAceCount += $this->checkAce($user_card);
        }

        $dealerAceCount      = 0;
        $dealer_select_cards = json_decode($gameLog->result);
        $length              = count($dealer_select_cards);

        for ($m = 0; $m < $length; $m++) {
            $dealer_card = array_pop($dealer_select_cards);
            $dealerAceCount += $this->checkAce($dealer_card);
        }

        $hiddenImage = $dealerSelectCard[0];

        $userSum   = $this->reduceAce($userCardSum, $userAceCount);
        $dealerSum = $this->reduceAce($dealerCardSum, $dealerAceCount);

        if ($userSum > 21) {
            $gameLog->win_status = Status::LOSS;
            $winStatus           = 'Loss';
        } else if ($dealerSum > 21) {
            $this->winBonus($gameLog, 'win');
            $gameLog->win_status = Status::WIN;
            $winStatus           = 'Win';
        } else if ($userSum == $dealerSum) {
            $this->winBonus($gameLog);
            $gameLog->win_status = Status::WIN;
            $winStatus           = 'Tie';
        } else if ($userSum > $dealerSum) {
            $this->winBonus($gameLog, 'win');
            $gameLog->win_status = Status::WIN;
            $winStatus           = 'Win';
        } else if ($userSum < $dealerSum) {
            $gameLog->win_status = Status::LOSS;
            $winStatus           = 'Loss';
        }

        $gameLog->status = Status::ENABLE;
        $gameLog->save();

        $notify[] = 'Black Jack game stay';
        return response()->json([
            'remark'  => 'game_stay_result',
            'status'  => 'success',
            'message' => ['success' => $notify],
            'data'    => [
                'hiddenImage' => $hiddenImage,
                'win_status'  => $winStatus,
                'userSum'     => $userSum,
                'dealerSum'   => $dealerSum,
                'game_log'    => $gameLog,
                'balance'     => showAmount(auth()->user()->balance, currencyFormat: false),
            ],
        ]);
    }

    protected function winBonus($data, $status = null) {
        $gameLog = $data;
        $user    = $gameLog->user;
        $game    = $gameLog->game;
        $winBon  = $gameLog->invest;
        if ($status) {
            $winBon += $gameLog->invest * $game->win / 100;
        }

        $user->balance += $winBon;
        $user->save();

        $gameLog->win_amo = $winBon;
        $gameLog->save();

        $transaction           = new Transaction();
        $transaction->user_id  = $user->id;
        $transaction->amount   = $winBon;
        $transaction->charge   = 0;
        $transaction->trx_type = '+';
        if ($status) {
            $transaction->details = 'Win bonus of ' . $game->name;
            $transaction->remark  = 'Win_Bonus';
        } else {
            $transaction->details = 'Match Tie of ' . $game->name;
            $transaction->remark  = 'invest_back';
        }
        $transaction->trx          = getTrx();
        $transaction->post_balance = $user->balance;
        $transaction->save();
        return true;
    }

    protected function reduceAce($userSum, $userAceCount) {
        while ($userSum > 21 && $userAceCount > 0) {
            $userSum -= 10;
            $userAceCount -= 1;
        }
        return $userSum;
    }

    public function blackjackAgain($id) {
        $user    = auth()->user();
        $gameLog = GameLog::where('user_id', $user->id)->where('id', $id)->first();
        if (!$gameLog) {
            $notify[] = 'Game logs not found';
            return response()->json([
                'remark'  => 'not_found',
                'status'  => 'error',
                'message' => ['error' => $notify],
            ]);
        }

        $game = $gameLog->game;

        if ($gameLog->invest > $user->balance) {
            $notify[] = 'Insufficient balance';
            return response()->json([
                'remark'  => 'insufficient_balance',
                'status'  => 'error',
                'message' => ['error' => $notify],
            ]);
        }

        $running = GameLog::where('status', 0)->where('user_id', $user->id)->where('game_id', $game->id)->first();

        if ($running) {
            return ['error' => '1 game is in-complete. Please wait'];
        }

        if ($gameLog->invest > $game->max_limit) {
            return ['error' => 'Please follow the maximum limit of invest'];
        }

        if ($gameLog->invest < $game->min_limit) {
            return ['error' => 'Please follow the minimum limit of invest'];
        }

        $values = ["A", "2", "3", "4", "5", "6", "7", "8", "9", "10", "J", "Q", "K"];
        $types  = ["C", "D", "H", "S"];
        $deck   = [];
        for ($i = 0; $i < count($types); $i++) {
            for ($j = 0; $j < count($values); $j++) {
                $deck[] = $values[$j] . "-" . $types[$i];
            }
        }
        for ($a = 0; $a < count($deck); $a++) {
            $randValue = ((float) rand() / (float) getrandmax()) * count($deck);
            $b         = (int) floor($randValue);
            $temp      = $deck[$a];
            $deck[$a]  = $deck[$b];
            $deck[$b]  = $temp;
        }

        $dealerSum = 0;
        $userSum   = 0;

        $dealerAceCount = 0;
        $userAceCount   = 0;

        $hidden = array_pop($deck);
        $dealerSum += $this->getValue($hidden);
        $dealerAceCount += $this->checkAce($hidden);

        while ($dealerSum < 17) {
            $dealerCard      = array_pop($deck);
            $dealerCardImg[] = $dealerCard;
            $dealerSum       = $dealerSum + $this->getValue($dealerCard);
            $dealerAceCount += $this->checkAce($dealerCard);
        }

        for ($m = 0; $m < 2; $m++) {
            $card      = array_pop($deck);
            $cardImg[] = $card;
            $userSum += $this->getValue($card);
            $userAceCount += $this->checkAce($card);
        }

        $user->balance -= $gameLog->invest;
        $user->save();

        $transaction               = new Transaction();
        $transaction->user_id      = $user->id;
        $transaction->amount       = $gameLog->invest;
        $transaction->charge       = 0;
        $transaction->trx_type     = '-';
        $transaction->details      = 'Invest to ' . $game->name;
        $transaction->remark       = 'invest';
        $transaction->trx          = getTrx();
        $transaction->post_balance = $user->balance;
        $transaction->save();

        $dealerResult = array_merge([$hidden], $dealerCardImg);

        $newGameLog              = new GameLog();
        $newGameLog->user_id     = $user->id;
        $newGameLog->game_id     = $game->id;
        $newGameLog->user_select = json_encode($cardImg);
        $newGameLog->result      = json_encode($dealerResult);
        $newGameLog->status      = 0;
        $newGameLog->win_status  = 0;
        $newGameLog->invest      = $gameLog->invest;
        $newGameLog->save();

        $notify[] = 'Black Jack game hit again';
        return response()->json([
            'remark'  => 'game_hit_again_result',
            'status'  => 'success',
            'message' => ['success' => $notify],
            'data'    => [
                'dealerSum'      => $dealerSum,
                'dealerAceCount' => $dealerAceCount,
                'userSum'        => $userSum,
                'userAceCount'   => $userAceCount,
                'dealerCardImg'  => $dealerCardImg,
                'cardImg'        => $cardImg,
                'game_log_id'    => $newGameLog->id,
                'balance'        => showAmount($user->balance, currencyFormat: false),
                'card'           => $deck,
            ],
        ]);
    }

    // ............... Mines ....................
    public function playMines($game, $request) {
        $validator = Validator::make($request->all(), [
            'invest' => 'required|numeric|gte:0',
            'mines'  => 'required|integer|min:1|max:20',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'remark'  => 'validation_error',
                'status'  => 'error',
                'message' => ['error' => $validator->errors()->all()],
            ]);
        }

        $user = auth()->user();

        $fallback = $this->fallback($request, $user, $game);

        if (@$fallback['error']) {
            return response()->json([
                'remark'  => 'fallback_error',
                'status'  => 'error',
                'message' => $fallback,
            ]);
        }

        $random = mt_rand(0, 100);
        if ($random <= $game->probable_win) {
            $win           = Status::WIN;
            $result        = $random;
            $availableMine = floor($result / 4);

            if (($request->mines + $availableMine) > 25) {
                $moreMines = ($request->mines + $availableMine) - 25;
                $availableMine -= $moreMines;
            }
        } else {
            $win           = Status::LOSS;
            $result        = 0;
            $availableMine = 0;
        }

        $invest                  = $this->invest($user, $request, $game, $result, $win);
        $gameLog                 = $invest['game_log'];
        $gameLog->mine_available = $availableMine;
        $gameLog->save();

        $res['game_log_id']    = $invest['game_log']->id;
        $res['balance']        = showAmount($user->balance, currencyFormat: false);
        $res['random']         = $random;
        $res['available_mine'] = $availableMine;
        $res['result']         = $invest['game_log']->result;

        // return response()->json($res);

        $notify[] = $game->name . ' investment data';
        return response()->json([
            'remark'  => 'investment_data',
            'status'  => 'success',
            'message' => ['success' => $notify],
            'data'    => $res,
        ]);
    }

    public function gameEndMines($game, $request) {
        $validator = $this->endValidation($request);

        if ($validator->fails()) {
            return response()->json([
                'remark'  => 'validation_error',
                'status'  => 'error',
                'message' => ['error' => $validator->errors()->all()],
            ]);
        }

        $gameLog = $this->runningGame();
        if (!$gameLog) {
            $notify[] = 'Game logs not found';
            return response()->json([
                'remark'  => 'not_found',
                'status'  => 'error',
                'message' => ['error' => $notify],
            ]);
        }

        if (!$gameLog->result) {
            $gameLog->status         = Status::GAME_FINISHED;
            $gameLog->win_status     = Status::LOSS;
            $gameLog->mine_available = 0;
            $gameLog->save();

            $res['type']    = 'danger';
            $res['sound']   = getImage('assets/audio/mine.mp3');
            $res['message'] = 'Oops! You Lost!!';
        } else {
            if ($gameLog->mine_available == 0) {
                $gameLog->status     = Status::GAME_FINISHED;
                $gameLog->win_status = Status::LOSS;

                $res['type']    = 'danger';
                $res['sound']   = getImage('assets/audio/mine.mp3');
                $res['message'] = 'Oops! You Lost!!';
            } else {
                $gameLog->gold_count += 1;
                $gameLog->mine_available -= 1;

                $winAmount = 0;
                $mineBonus = GuessBonus::where('alias', $game->alias)->where('chance', $gameLog->mines)->first();
                if ($mineBonus) {
                    $winAmount = $gameLog->invest + ($gameLog->invest * ($gameLog->gold_count * $mineBonus->percent) / 100);
                }
                $gameLog->win_amo = $winAmount;

                $res['type']  = 'success';
                $res['sound'] = getImage('assets/audio/win.wav');
            }
            $gameLog->save();
        }

        $res['mines']            = $gameLog->mines;
        $res['balance']          = showAmount(auth()->user()->balance, currencyFormat: false);
        $res['mine_available']   = $gameLog->mine_available;
        $res['game_log_id']      = $gameLog->id;
        $res['gold_count']       = $gameLog->gold_count;
        $res['mine_image']       = getImage(activeTemplate(true) . 'images/mines/mines.png');
        $res['gold_image']       = getImage(activeTemplate(true) . 'images/mines/gold.png');
        $res['gold_transparent'] = getImage(activeTemplate(true) . 'images/mines/gold_transparent.png');

        $notify[] = $game->name . ' game result';
        return response()->json([
            'remark'  => 'game_result',
            'status'  => 'success',
            'message' => ['success' => $notify],
            'data'    => $res,
        ]);
    }

    public function mineCashout(Request $request) {
        $validator = Validator::make($request->all(), [
            'game_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'remark'  => 'validation_error',
                'status'  => 'error',
                'message' => ['error' => $validator->errors()->all()],
            ]);
        }

        $gameLog = $this->runningGame();

        if (!$gameLog) {
            $notify[] = 'Game logs not found';
            return response()->json([
                'remark'  => 'not_found',
                'status'  => 'error',
                'message' => ['error' => $notify],
            ]);
        }

        $gameLog->status     = Status::GAME_FINISHED;
        $gameLog->win_status = Status::WIN;
        $gameLog->save();

        $user = auth()->user();
        $user->balance += $gameLog->win_amo;
        $user->save();

        $game = $gameLog->game;

        $transaction               = new Transaction();
        $transaction->user_id      = $user->id;
        $transaction->amount       = $gameLog->win_amo;
        $transaction->charge       = 0;
        $transaction->trx_type     = '+';
        $transaction->details      = 'Win bonus of ' . $game->name;
        $transaction->remark       = 'Win_Bonus';
        $transaction->trx          = getTrx();
        $transaction->post_balance = $user->balance;
        $transaction->save();

        $notify[] = 'Game cashout successful';
        return response()->json([
            'remark'  => 'game_cashout',
            'status'  => 'success',
            'message' => ['success' => $notify],
            'data'    => [
                'balance' => showAmount($user->balance, currencyFormat: false),
                'sound'   => getImage('assets/audio/win.wav'),
                'success' => 'Congratulation! you won ' . showAmount($gameLog->win_amo, currencyFormat: false) . ' ' . gs('cur_text'),
            ],
        ]);
    }

    // ............... Casino Dice ....................
    public function diceSubmit(Request $request) {
        $validator = Validator::make($request->all(), [
            'percent' => 'required|numeric|gt:0',
            'invest'  => 'required|numeric|gt:0',
            'range'   => 'required|in:low,high',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'remark'  => 'validation_error',
                'status'  => 'error',
                'message' => ['error' => $validator->errors()->all()],
            ]);
        }

        $user    = auth()->user();
        $running = GameLog::where('user_id', $user->id)->where('game_id', 10)->where('status', Status::GAME_RUNNING)->count();
        if ($running) {
            $notify[] = 'You have a unfinished game. please wait';
            return response()->json([
                'remark'  => 'unfinished_game.',
                'status'  => 'error',
                'message' => ['error' => $notify],
            ]);
        }
        $general = gs();
        $game    = Game::findOrFail(10);
        if ($request->invest < $game->min_limit) {
            $notify[] = 'Minimum invest limit is ' . showAmount($game->min_limit) . ' ' . $general->cur_text;
            return response()->json([
                'remark'  => 'min_limit',
                'status'  => 'error',
                'message' => ['error' => $notify],
            ]);
        }
        if ($request->invest > $game->max_limit) {
            $notify[] = 'Maximum invest limit is ' . showAmount($game->max_limit) . ' ' . $general->cur_text;
            return response()->json([
                'remark'  => 'max_limit',
                'status'  => 'error',
                'message' => ['error' => $notify],
            ]);
        }
        if ($request->invest > $user->balance) {
            $notify[] = 'Insufficient balance';
            return response()->json([
                'remark'  => 'insufficient_balance',
                'status'  => 'error',
                'message' => ['error' => $notify],
            ]);
        }

        $winChance   = $request->percent;
        $amount      = $request->invest;
        $lessThan    = $winChance * 100;
        $greaterThan = 9900 - ($winChance * 100) + 99;
        $payout      = round(99 / $winChance, 4);
        $winAmo      = $amount * $payout;
        $allChances  = rand(1, 98);
        $choose      = $request->range;

        if ($winChance >= $allChances) {
            $win = Status::WIN;
        } else {
            $win = Status::LOSS;
        }

        if ($win == Status::WIN) {
            if ($choose == 'low') {
                $number = rand(100, $lessThan);
            } else {
                $number = rand($greaterThan, 9899);
            }
        } else {
            if ($choose == 'low') {
                $number = rand(($lessThan + 1), 9899);
            } else {
                $number = rand(100, ($greaterThan - 1));
            }
        }
        if (strlen((string) $number) < 4) {
            $number = '0' . $number;
        }

        $invest            = $this->invest($user, $request, $game, $number, $win, $winAmo);
        $res['gameLog_id'] = $invest['game_log']->id;
        $res['balance']    = showAmount($user->balance, currencyFormat: false);

        $notify[] = $game->name . ' investment data';
        return response()->json([
            'remark'  => 'investment_data',
            'status'  => 'success',
            'message' => ['success' => $notify],
            'data'    => $res,
        ]);
    }

    public function diceResult(Request $request) {
        $validator = Validator::make($request->all(), [
            'game_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'remark'  => 'validation_error',
                'status'  => 'error',
                'message' => ['error' => $validator->errors()->all()],
            ]);
        }
        $user    = auth()->user();
        $gameLog = GameLog::where('user_id', $user->id)->where('id', $request->game_id)->where('status', Status::GAME_RUNNING)->first();

        if (!$gameLog) {
            $notify[] = 'Game not found';
            return response()->json([
                'remark'  => 'not_found',
                'status'  => 'error',
                'message' => ['error' => $notify],
            ]);
        }

        if ($gameLog->win_status == Status::WIN) {
            $user->balance += $gameLog->win_amo;
            $user->save();

            $transaction               = new Transaction();
            $transaction->user_id      = $user->id;
            $transaction->amount       = $gameLog->win_amo;
            $transaction->charge       = 0;
            $transaction->trx_type     = '+';
            $transaction->details      = 'Win bonus of ' . @$gameLog->game->name;
            $transaction->remark       = 'Win_Bonus';
            $transaction->trx          = getTrx();
            $transaction->post_balance = $user->balance;
            $transaction->save();
        }
        $gameLog->status = Status::GAME_FINISHED;
        $gameLog->save();

        $notify[] = 'Casino Dice game result';
        return response()->json([
            'remark'  => 'game_result',
            'status'  => 'success',
            'message' => ['success' => $notify],
            'data'    => [
                'result'  => $gameLog->result,
                'win'     => $gameLog->win_status,
                'balance' => showAmount($user->balance, currencyFormat: false),
            ],
        ]);
    }

    // ............... Poker ....................
    public function playPoker($game, $request) {
        $validator = Validator::make($request->all(), [
            'invest' => 'required|numeric|gte:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'remark'  => 'validation_error',
                'status'  => 'error',
                'message' => ['error' => $validator->errors()->all()],
            ]);
        }

        $user = auth()->user();

        $fallback = $this->fallback($request, $user, $game);

        if (@$fallback['error']) {
            return response()->json([
                'remark'  => 'fallback_error',
                'status'  => 'error',
                'message' => $fallback,
            ]);
        }

        $random = mt_rand(0, 100);

        if ($random <= $game->probable_win) {
            $win = Status::WIN;

            $rankName = [
                'royal_flush',
                'straight_flush',
                'four_of_a_kind',
                'full_house',
                'flush',
                'straight',
                'three_of_a_kind',
                'two_pair',
                'pair',
                'high_card',
            ];

            $targetRank = $rankName[rand(0, 9)];
            $rankGet    = true;
            while ($rankGet) {
                $hand = $this->generatePokerHand($targetRank);
                $rank = $this->hasSpecificHand($hand);
                if ($rank != 'no_match') {
                    $rankGet = false;
                }
            }
        } else {
            $win  = Status::LOSS;
            $deck = $this->initializeDeck();
            $hand = $this->dealCardsWithoutRank($deck);
            $rank = $this->hasSpecificHand($hand);
        }
        $result = $hand;
        $invest = $this->invest($user, $request, $game, $result, $win);

        $res['game_log_id'] = $invest['game_log']->id;
        $res['balance']     = showAmount($user->balance, currencyFormat: false);
        $res['message']     = showAmount($request->invest) . ' ' . 'betted successfully';

        $notify[] = $game->name . ' investment data';
        return response()->json([
            'remark'  => 'investment_data',
            'status'  => 'success',
            'message' => ['success' => $notify],
            'data'    => $res,
        ]);
    }

    private function initializeDeck() {
        $suits = ['H', 'D', 'C', 'S'];
        $ranks = ['2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K', 'A'];
        $deck  = [];
        foreach ($suits as $suit) {
            foreach ($ranks as $rank) {
                $deck[] = $rank . '-' . $suit;
            }
        }
        shuffle($deck);
        return $deck;
    }

    function generatePokerHand($targetRank) {
        $suits = ['H', 'D', 'C', 'S'];
        $ranks = ['2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K', 'A'];

        $hand = [];

        switch ($targetRank) {
        case 'royal_flush':
            $suit = $suits[rand(0, 3)];
            $hand = ["A-$suit", "K-$suit", "Q-$suit", "J-$suit", "10-$suit"];
            break;

        case 'straight_flush':
            $suit       = $suits[rand(0, 3)];
            $startIndex = rand(0, 9); // To ensure a valid straight
            for ($i = $startIndex; $i < $startIndex + 5; $i++) {
                $hand[] = $ranks[$i % 13] . "-$suit";
            }

            usort($hand, function ($a, $b) use ($ranks) {
                $rankA = array_search(substr($a, 0, -2), $ranks);
                $rankB = array_search(substr($b, 0, -2), $ranks);
                return $rankB - $rankA;
            });
            break;

        case 'four_of_a_kind':
            $rank = $ranks[rand(0, 12)];
            $hand = [$rank . '-H', $rank . '-D', $rank . '-C', $rank . '-S', $ranks[rand(0, 12)] . '-H'];

            usort($hand, function ($a, $b) use ($rank) {
                return substr($a, 0, -2) === $rank ? -1 : 1;
            });
            break;

        case 'full_house':
            $rank1 = $ranks[rand(0, 12)];
            $rank2 = $ranks[rand(0, 12)];
            while ($rank2 == $rank1) {
                $rank2 = $ranks[rand(0, 12)];
            }
            $hand = [$rank1 . '-H', $rank1 . '-D', $rank1 . '-C', $rank2 . '-S', $rank2 . '-H'];

            usort($hand, function ($a, $b) use ($rank1, $rank2) {
                $rankA = array_search(substr($a, 0, -2), [$rank1, $rank2]);
                $rankB = array_search(substr($b, 0, -2), [$rank1, $rank2]);
                return $rankA - $rankB;
            });
            break;

        case 'flush':
            $suit = $suits[rand(0, 3)];
            for ($i = 0; $i < 5; $i++) {
                $hand[] = $ranks[rand(0, 12)] . "-$suit";
            }
            usort($hand, function ($a, $b) use ($ranks) {
                $rankA = array_search(substr($a, 0, -2), $ranks);
                $rankB = array_search(substr($b, 0, -2), $ranks);
                return $rankB - $rankA;
            });
            break;

        case 'straight':
            $startIndex = rand(0, 9);
            for ($i = $startIndex; $i < $startIndex + 5; $i++) {
                $hand[] = $ranks[$i % 13] . '-' . $suits[rand(0, 3)];
            }
            usort($hand, function ($a, $b) use ($ranks) {
                $rankA = array_search(substr($a, 0, -2), $ranks);
                $rankB = array_search(substr($b, 0, -2), $ranks);
                return $rankB - $rankA;
            });
            break;

        case 'three_of_a_kind':
            $rank = $ranks[rand(0, 12)];
            $hand = [$rank . '-H', $rank . '-D', $rank . '-C', $ranks[rand(0, 12)] . '-S', $ranks[rand(0, 12)] . '-H'];
            usort($hand, function ($a, $b) use ($rank) {
                if (substr($a, 0, -2) === $rank) {
                    return -1;
                } else if (substr($b, 0, -2) === $rank) {
                    return 1;
                } else {
                    return 0;
                }
            });
            break;

        case 'two_pair':
            $rank1 = $ranks[rand(0, 12)];
            $rank2 = $ranks[rand(0, 12)];
            while ($rank2 == $rank1) {
                $rank2 = $ranks[rand(0, 12)];
            }
            $hand = [$rank1 . '-H', $rank1 . '-D', $rank2 . '-C', $rank2 . '-S', $ranks[rand(0, 12)] . '-H'];
            usort($hand, function ($a, $b) use ($rank1, $rank2) {
                $rankA = array_search(substr($a, 0, -2), [$rank1, $rank2]);
                $rankB = array_search(substr($b, 0, -2), [$rank1, $rank2]);
                return $rankA - $rankB;
            });
            break;

        case 'pair':
            $rank = $ranks[rand(0, 12)];
            $hand = [$rank . '-H', $rank . '-D', $ranks[rand(0, 12)] . '-C', $ranks[rand(0, 12)] . '-S', $ranks[rand(0, 12)] . '-H'];
            usort($hand, function ($a, $b) use ($rank) {
                if (substr($a, 0, -2) === $rank) {
                    return -1;
                } else if (substr($b, 0, -2) === $rank) {
                    return 1;
                } else {
                    return 0;
                }
            });
            break;

        case 'high_card':
            for ($i = 0; $i < 5; $i++) {
                $hand[] = $ranks[rand(0, 12)] . '-' . $suits[rand(0, 3)];
            }
            usort($hand, function ($a, $b) use ($ranks) {
                $rankA = array_search(substr($a, 0, -2), $ranks);
                $rankB = array_search(substr($b, 0, -2), $ranks);
                return $rankB - $rankA;
            });
            break;

        default:
            break;
        }

        return $hand;
    }

    private function hasSpecificHand($hand) {
        $handTypes = [
            'royal_flush',
            'straight_flush',
            'four_of_a_kind',
            'full_house',
            'flush',
            'straight',
            'three_of_a_kind',
            'two_pair',
            'pair',
            'high_card',
        ];

        foreach ($handTypes as $handType) {
            $methodName = 'is' . str_replace('_', '', ucwords($handType, '_'));
            if ($this->$methodName($hand)) {
                return $handType;
            }
        }

        return 'no_match';
    }

    private function dealCardsWithoutRank($deck) {
        $hand = [];

        while (count($hand) < 5) {
            $card = array_shift($deck);

            $currentRank = explode('-', $card)[0];
            $ranksInHand = array_map(function ($c) {
                return explode('-', $c)[0];
            }, $hand);

            if (!in_array($currentRank, $ranksInHand)) {
                $hand[] = $card;
            }
        }

        return $hand;
    }

    public function isRoyalFlush($hand) {
        $requiredRanks = ['10', 'J', 'Q', 'K', 'A'];
        $requiredSuits = array_unique(array_map(function ($card) {
            return explode('-', $card)[1];
        }, $hand));

        return count(array_intersect($requiredRanks, $this->getRanks($hand))) === 5
        && count($requiredSuits) === 1;
    }

    public function isStraightFlush($hand) {
        $ranks = $this->getRanks($hand);
        $suit  = explode('-', $hand[0])[1];

        return count($ranks) === 5
        && count(array_diff($ranks, array_values(range(min($ranks), max($ranks))))) === 0
        && count(array_unique(array_map(function ($card) {
            return explode('-', $card)[1];
        }, $hand))) === 1;
    }

    public function isFourOfAKind($hand) {
        $rankCount = array_count_values($this->getRanks($hand));
        return in_array(4, $rankCount);
    }

    public function isFullHouse($hand) {
        $rankCount = array_count_values($this->getRanks($hand));
        return in_array(3, $rankCount) && in_array(2, $rankCount);
    }

    public function isFlush($hand) {
        $suits = array_map(function ($card) {
            return explode('-', $card)[1];
        }, $hand);

        return count(array_unique($suits)) === 1;
    }

    public function isStraight($hand) {
        $ranks = $this->getRanks($hand);

        return count($ranks) === 5
        && count(array_diff($ranks, array_values(range(min($ranks), max($ranks))))) === 0
        && count(array_unique($ranks)) === 5;
    }

    public function isThreeOfAKind($hand) {
        $rankCount = array_count_values($this->getRanks($hand));
        return in_array(3, $rankCount);
    }

    public function isTwoPair($hand) {
        $rankCount = array_count_values($this->getRanks($hand));
        return count(array_filter($rankCount, function ($count) {
            return $count === 2;
        })) === 2;
    }

    public function isPair($hand) {
        $rankCount = array_count_values($this->getRanks($hand));
        return in_array(2, $rankCount);
    }

    public function isHighCard($hand) {
        $ranks = $this->getRanks($hand);

        return count($ranks) === 5
        && count(array_diff($ranks, array_values(range(min($ranks), max($ranks))))) === 0
        && count(array_unique($ranks)) === 5;
    }

    private function getRanks($hand) {
        return array_map(function ($card) {
            return explode('-', $card)[0];
        }, $hand);
    }

    public function pokerDeal(Request $request) {
        $validator = Validator::make($request->all(), [
            'game_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'remark'  => 'validation_error',
                'status'  => 'error',
                'message' => ['error' => $validator->errors()->all()],
            ]);
        }

        $gameLog = $this->runningGame();

        if (!$gameLog) {
            $notify[] = 'Game logs not found';
            return response()->json([
                'remark'  => 'not_found',
                'status'  => 'error',
                'message' => ['error' => $notify],
            ]);
        }
        $res['result'] = array_slice(json_decode($gameLog->result), 0, 3);
        $res['path']   = asset(activeTemplate(true) . '/images/cards/');

        $notify[] = 'Poker deal data';
        return response()->json([
            'remark'  => 'deal_data',
            'status'  => 'success',
            'message' => ['success' => $notify],
            'data'    => $res,
        ]);
    }

    public function pokerCall(Request $request) {
        $validator = Validator::make($request->all(), [
            'game_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'remark'  => 'validation_error',
                'status'  => 'error',
                'message' => ['error' => $validator->errors()->all()],
            ]);
        }

        $gameLog = $this->runningGame();

        if (!$gameLog) {
            $notify[] = 'Game logs not found';
            return response()->json([
                'remark'  => 'not_found',
                'status'  => 'error',
                'message' => ['error' => $notify],
            ]);
        }

        $rank = $this->hasSpecificHand(json_decode($gameLog->result));
        $user = $gameLog->user;

        if ($rank == 'no_match' || $gameLog->win_status == Status::LOSS) {
            $gameLog->status = Status::GAME_FINISHED;
            $gameLog->save();

            $res['message'] = 'Oops! You Lost!!';
            $res['type']    = 'danger';
            $res['sound']   = getImage('assets/audio/lose.wav');
        } else {
            $ranks = [
                'royal_flush',
                'straight_flush',
                'four_of_a_kind',
                'full_house',
                'flush',
                'straight',
                'three_of_a_kind',
                'two_pair',
                'pair',
                'high_card',
            ];

            $rankNumber = array_search($rank, $ranks);
            $game       = $gameLog->game;
            $bonus      = 0;

            $rankBonus = GuessBonus::where('alias', $game->alias)->where('chance', $rankNumber + 1)->first();
            if ($rankBonus) {
                $bonus = $rankBonus->percent;
            }

            $winAmount = $gameLog->invest + ($gameLog->invest * $bonus / 100);

            $gameLog->win_amo    = $winAmount;
            $gameLog->win_status = Status::WIN;
            $gameLog->status     = Status::GAME_FINISHED;
            $gameLog->save();

            $user->balance += $winAmount;
            $user->save();

            $transaction               = new Transaction();
            $transaction->user_id      = $user->id;
            $transaction->amount       = $winAmount;
            $transaction->charge       = 0;
            $transaction->trx_type     = '+';
            $transaction->details      = 'Win bonus of ' . $game->name;
            $transaction->remark       = 'Win_Bonus';
            $transaction->trx          = getTrx();
            $transaction->post_balance = $user->balance;
            $transaction->save();

            $res['message'] = 'Yahoo! You Win!!!';
            $res['type']    = 'success';
            $res['balance'] = showAmount($user->balance, currencyFormat: false);
            $res['sound']   = getImage('assets/audio/win.wav');
        }

        $res['rank']    = str_replace("_", " ", $rank);
        $res['balance'] = showAmount($user->balance, currencyFormat: false);
        $res['result']  = array_slice(json_decode($gameLog->result), 3, 5);
        $res['path']    = asset(activeTemplate(true) . '/images/cards/');

        $notify[] = 'Poker Call data';
        return response()->json([
            'remark'  => 'call_data',
            'status'  => 'success',
            'message' => ['success' => $notify],
            'data'    => $res,
        ]);
    }

    public function pokerFold(Request $request) {
        $validator = Validator::make($request->all(), [
            'game_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'remark'  => 'validation_error',
                'status'  => 'error',
                'message' => ['error' => $validator->errors()->all()],
            ]);
        }

        $gameLog = $this->runningGame();

        if (!$gameLog) {
            $notify[] = 'Game logs not found';
            return response()->json([
                'remark'  => 'not_found',
                'status'  => 'error',
                'message' => ['error' => $notify],
            ]);
        }

        $gameLog->status = Status::GAME_FINISHED;
        $gameLog->save();

        $res['message'] = 'Oops! You Lost!!';
        $res['type']    = 'danger';
        $res['sound']   = getImage('assets/audio/lose.wav');
        $res['rank']    = 'no rank';

        $res['balance'] = showAmount(auth()->user()->balance, currencyFormat: false);

        $notify[] = 'Poker fold data';
        return response()->json([
            'remark'  => 'fold_data',
            'status'  => 'success',
            'message' => ['success' => $notify],
            'data'    => $res,
        ]);
    }

    public function investValidation($request, $in) {
        return Validator::make($request->all(), [
            'invest' => 'required|numeric|gt:0',
            'choose' => 'required|in:' . $in,
        ]);
    }

    public function fallback($request, $user, $game) {

        if ($request->invest > $user->balance) {
            return ['error' => ['Oops! You have no sufficient balance']];
        }

        $running = GameLog::where('status', 0)->where('user_id', $user->id)->where('game_id', $game->id)->first();

        if ($running) {
            return ['error' => ['1 game is in-complete. Please wait']];
        }

        if ($request->invest > $game->max_limit) {
            return ['error' => 'Please follow the maximum limit of invest'];
        }

        if ($request->invest < $game->min_limit) {
            return ['error' => ['Please follow the minimum limit of invest']];
        }

        return ['success'];
    }

    public function invest($user, $request, $game, $result, $win, $winAmount = 0) {
        $user->balance -= $request->invest;
        $user->save();

        $transaction               = new Transaction();
        $transaction->user_id      = $user->id;
        $transaction->amount       = $request->invest;
        $transaction->charge       = 0;
        $transaction->trx_type     = '-';
        $transaction->details      = 'Invest to ' . $game->name;
        $transaction->remark       = 'invest';
        $transaction->trx          = getTrx();
        $transaction->post_balance = $user->balance;
        $transaction->save();

        $gameLog                 = new GameLog();
        $gameLog->user_id        = $user->id;
        $gameLog->game_id        = $game->id;
        $gameLog->user_select    = in_array($game->alias, ['keno']) ? json_encode($request->choose) : @$request->choose;
        $gameLog->result         = in_array($game->alias, ['number_slot', 'roulette', 'keno', 'poker']) ? json_encode($result) : $result;
        $gameLog->status         = 0;
        $gameLog->win_status     = $win;
        $gameLog->invest         = $request->invest;
        $gameLog->win_amo        = $winAmount;
        $gameLog->mines          = @$request->mines ?? 0;
        $gameLog->mine_available = @$request->mines ?? 0;
        $gameLog->save();
        $gameLog->win_status = null;
        $gameLog->win_amo    = null;
        return ['game_log' => $gameLog];
    }

    // ................................... Same Game Loop Start ..........................................
    public function gameEndHeadTail($game, $request) {
        $validator = $this->endValidation($request);

        if ($validator->fails()) {
            return response()->json([
                'remark'  => 'validation_error',
                'status'  => 'error',
                'message' => ['error' => $validator->errors()->all()],
            ]);
        }

        $gameLog = $this->runningGame();
        if (!$gameLog) {
            $notify[] = 'Game logs not found';
            return response()->json([
                'remark'  => 'not_found',
                'status'  => 'error',
                'message' => ['error' => $notify],
            ]);
        }

        if ($gameLog->status == Status::GAME_FINISHED) {
            $notify[] = 'The game is already over';
            return response()->json([
                'remark'  => 'game_over',
                'status'  => 'error',
                'message' => ['error' => $notify],
            ]);
        }

        $res = $this->gameResult($game, $gameLog);

        $notify[] = $game->name . ' game result';
        return response()->json([
            'remark'  => 'game_result',
            'status'  => 'success',
            'message' => ['success' => $notify],
            'data'    => $res,
        ]);
    }

    public function gameEndRockPaperScissors($game, $request) {
        $validator = $this->endValidation($request);

        if ($validator->fails()) {
            return response()->json([
                'remark'  => 'validation_error',
                'status'  => 'error',
                'message' => ['error' => $validator->errors()->all()],
            ]);
        }

        $gameLog = $this->runningGame();

        if (!$gameLog) {
            $notify[] = 'Game logs not found';
            return response()->json([
                'remark'  => 'not_found',
                'status'  => 'error',
                'message' => ['error' => $notify],
            ]);
        }

        if ($gameLog->status == Status::GAME_FINISHED) {
            $notify[] = 'The game is already over';
            return response()->json([
                'remark'  => 'game_over',
                'status'  => 'error',
                'message' => ['error' => $notify],
            ]);
        }

        $res = $this->gameResult($game, $gameLog);

        $notify[] = $game->name . ' game result';
        return response()->json([
            'remark'  => 'game_result',
            'status'  => 'success',
            'message' => ['success' => $notify],
            'data'    => $res,
        ]);
    }

    public function gameEndSpinWheel($game, $request) {
        $validator = $this->endValidation($request);

        if ($validator->fails()) {
            return response()->json([
                'remark'  => 'validation_error',
                'status'  => 'error',
                'message' => ['error' => $validator->errors()->all()],
            ]);
        }

        $gameLog = $this->runningGame();

        if (!$gameLog) {
            $notify[] = 'Game logs not found';
            return response()->json([
                'remark'  => 'not_found',
                'status'  => 'error',
                'message' => ['error' => $notify],
            ]);
        }

        if ($gameLog->status == Status::GAME_FINISHED) {
            $notify[] = 'The game is already over';
            return response()->json([
                'remark'  => 'game_over',
                'status'  => 'error',
                'message' => ['error' => $notify],
            ]);
        }

        $res = $this->gameResult($game, $gameLog);

        $notify[] = $game->name . ' game result';
        return response()->json([
            'remark'  => 'game_result',
            'status'  => 'success',
            'message' => ['success' => $notify],
            'data'    => $res,
        ]);
    }

    public function gameEndNumberGuess($game, $request) {

        $validator = Validator::make($request->all(), [
            'game_id' => 'required|integer|exists:game_logs,id',
            'number'  => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'remark'  => 'validation_error',
                'status'  => 'error',
                'message' => ['error' => $validator->errors()->all()],
            ]);
        }

        if ($request->number < 1 || $request->number > 100) {
            $notify[] = 'Enter a number between 1 and 100';
            return response()->json([
                'remark'  => 'validation_error',
                'status'  => 'error',
                'message' => ['error' => $notify],
            ]);
        }

        $gameLog = $this->runningGame();

        if (!$gameLog) {
            $notify[] = 'Game logs not found';
            return response()->json([
                'remark'  => 'not_found',
                'status'  => 'error',
                'message' => ['error' => $notify],
            ]);
        }
        $user = auth()->user();
        if ($gameLog->status == Status::GAME_FINISHED) {
            $mes['gameSt']  = 1;
            $mes['message'] = 'Time Over';

            $notify[] = 'The game is already over';
            return response()->json([
                'remark'  => 'game_over',
                'status'  => 'error',
                'message' => ['error' => $notify],
                'data'    => $mes,
            ]);
        }
        if ($gameLog->user_select != null) {
            $userSelect = json_decode($gameLog->user_select);
            array_push($userSelect, $request->number);
        } else {
            $userSelect[] = $request->number;
        }

        $data  = GuessBonus::where('alias', $game->alias)->get();
        $count = $data->count();

        $gameLog->try += 1;
        $gameLog->user_select = json_encode($userSelect);

        if ($gameLog->try >= $count) {
            $gameLog->status = Status::ENABLE;
        }

        $gameLog->save();

        $percent = 0;
        $bonus   = GuessBonus::where('alias', $game->alias)->where('chance', $gameLog->try)->first();
        if ($bonus) {
            $percent = $bonus->percent;
        }

        $amount = $gameLog->invest * $percent / 100;

        $user = $gameLog->user;

        $result = $gameLog->result;

        if ($request->number < $result) {
            $mes['message'] = 'The Number is short';
            $win            = Status::LOSS;
            $mes['type']    = 0;
        }

        if ($request->number > $result) {
            $mes['message'] = 'The Number is high';
            $win            = Status::LOSS;
            $mes['type']    = 1;
        }

        if ($gameLog->status == Status::GAME_FINISHED) {
            $mes['gameSt']     = 1;
            $mes['message']    = 'Oops You Lost! The Number was ' . $gameLog->result;
            $mes['win_status'] = 0;
            $mes['win_number'] = $gameLog->result;
        } else {
            $nextBonus   = GuessBonus::where('alias', $game->alias)->where('chance', $gameLog->try + 1)->first();
            $mes['data'] = $nextBonus->percent . '%';
        }

        if ($request->number == $result) {

            $gameLog->win_status = Status::WIN;
            $gameLog->status     = Status::ENABLE;
            $gameLog->win_amo    = $amount;
            $gameLog->save();

            $user->balance += $amount;
            $user->save();

            $transaction               = new Transaction();
            $transaction->user_id      = $user->id;
            $transaction->amount       = $amount;
            $transaction->charge       = 0;
            $transaction->trx_type     = '+';
            $transaction->details      = $bonus . '% Bonus For Number Guessing Game';
            $transaction->remark       = 'Win_Bonus';
            $transaction->trx          = getTrx();
            $transaction->post_balance = $user->balance;
            $transaction->save();

            $mes['gameSt']     = 1;
            $mes['message']    = 'This is the number';
            $mes['win_status'] = 1;
            $mes['win_number'] = $gameLog->result;
        }

        $mes['bal'] = showAmount($user->balance, currencyFormat: false);

        $notify[] = $game->name . ' game result';
        return response()->json([
            'remark'  => 'game_result',
            'status'  => 'success',
            'message' => ['success' => $notify],
            'data'    => $mes,
        ]);
    }

    public function gameEndDiceRolling($game, $request) {
        $validator = $this->endValidation($request);

        if ($validator->fails()) {
            return response()->json([
                'remark'  => 'validation_error',
                'status'  => 'error',
                'message' => ['error' => $validator->errors()->all()],
            ]);
        }

        $gameLog = $this->runningGame();

        if (!$gameLog) {
            $notify[] = 'Game logs not found';
            return response()->json([
                'remark'  => 'not_found',
                'status'  => 'error',
                'message' => ['error' => $notify],
            ]);
        }

        if ($gameLog->status == Status::GAME_FINISHED) {
            $notify[] = 'The game is already over';
            return response()->json([
                'remark'  => 'game_over',
                'status'  => 'error',
                'message' => ['error' => $notify],
            ]);
        }

        $res = $this->gameResult($game, $gameLog);

        $notify[] = $game->name . ' game result';
        return response()->json([
            'remark'  => 'game_result',
            'status'  => 'success',
            'message' => ['success' => $notify],
            'data'    => $res,
        ]);
    }

    public function gameEndCardFinding($game, $request) {
        $validator = $this->endValidation($request);

        if ($validator->fails()) {
            return response()->json([
                'remark'  => 'validation_error',
                'status'  => 'error',
                'message' => ['error' => $validator->errors()->all()],
            ]);
        }

        $gameLog = $this->runningGame();

        if (!$gameLog) {
            $notify[] = 'Game logs not found';
            return response()->json([
                'remark'  => 'not_found',
                'status'  => 'error',
                'message' => ['error' => $notify],
            ]);
        }

        if ($gameLog->status == Status::GAME_FINISHED) {
            $notify[] = 'The game is already over';
            return response()->json([
                'remark'  => 'game_over',
                'status'  => 'error',
                'message' => ['error' => $notify],
            ]);
        }

        $res = $this->gameResult($game, $gameLog);

        $notify[] = $game->name . ' game result';
        return response()->json([
            'remark'  => 'game_result',
            'status'  => 'success',
            'message' => ['success' => $notify],
            'data'    => $res,
        ]);
    }

    public function gameEndNumberPool($game, $request) {
        $validator = $this->endValidation($request);

        if ($validator->fails()) {
            return response()->json([
                'remark'  => 'validation_error',
                'status'  => 'error',
                'message' => ['error' => $validator->errors()->all()],
            ]);
        }

        $gameLog = $this->runningGame();

        if (!$gameLog) {
            $notify[] = 'Game logs not found';
            return response()->json([
                'remark'  => 'not_found',
                'status'  => 'error',
                'message' => ['error' => $notify],
            ]);
        }

        if ($gameLog->status == Status::GAME_FINISHED) {
            $notify[] = 'The game is already over';
            return response()->json([
                'remark'  => 'game_over',
                'status'  => 'error',
                'message' => ['error' => $notify],
            ]);
        }

        $res = $this->gameResult($game, $gameLog);

        $notify[] = $game->name . ' game result';
        return response()->json([
            'remark'  => 'game_result',
            'status'  => 'success',
            'message' => ['success' => $notify],
            'data'    => $res,
        ]);
    }

    public function gameEndNumberSlot($game, $request) {
        $validator = $this->endValidation($request);

        if ($validator->fails()) {
            return response()->json([
                'remark'  => 'validation_error',
                'status'  => 'error',
                'message' => ['error' => $validator->errors()->all()],
            ]);
        }

        $user    = auth()->user();
        $gameLog = $this->runningGame();

        if (!$gameLog) {
            $notify[] = 'Game logs not found';
            return response()->json([
                'remark'  => 'not_found',
                'status'  => 'error',
                'message' => ['error' => $notify],
            ]);
        }

        if ($gameLog->status == Status::GAME_FINISHED) {
            $notify[] = 'The game is already over';
            return response()->json([
                'remark'  => 'game_over',
                'status'  => 'error',
                'message' => ['error' => $notify],
            ]);
        }
        $winner = 0;
        $trx    = getTrx();

        foreach ($game->level as $key => $data) {

            if ($gameLog->win_status == $key + 1) {
                $winBon = $gameLog->invest * $game->level[$key] / 100;
                $amo    = $winBon;
                $user->balance += $amo;
                $user->save();

                $gameLog->win_amo = $amo;
                $gameLog->save();

                $winner = 1;
                $lev    = $key + 1;

                $transaction               = new Transaction();
                $transaction->user_id      = $user->id;
                $transaction->amount       = $winBon;
                $transaction->charge       = 0;
                $transaction->trx_type     = '+';
                $transaction->details      = $game->level[$key] . '% Win bonus of Number Slot Game ' . $lev . ' Time';
                $transaction->remark       = 'win_bonus';
                $transaction->trx          = $trx;
                $transaction->post_balance = $user->balance;
                $transaction->save();
            }
        }

        if ($winner == 1) {
            $res['user_choose'] = $gameLog->user_select;
            $res['message']     = 'Yahoo! You Win for ' . $gameLog->win_status . ' Time !!!';
            $res['type']        = 'success';
            $res['bal']         = showAmount($user->balance, currencyFormat: false);
        } else {
            $res['user_choose'] = $gameLog->user_select;
            $res['message']     = 'Oops! You Lost!!';
            $res['type']        = 'danger';
            $res['bal']         = showAmount($user->balance, currencyFormat: false);
        }

        $gameLog->status = Status::ENABLE;
        $gameLog->save();

        $notify[] = $game->name . ' game result';
        return response()->json([
            'remark'  => 'game_result',
            'status'  => 'success',
            'message' => ['success' => $notify],
            'data'    => $res,
        ]);
    }
    // ................................... Same Game Loop End ..........................................

    public function endValidation($request) {
        return Validator::make($request->all(), [
            'game_id' => 'required|integer|exists:game_logs,id',
        ]);
    }

    public function runningGame() {
        return GameLog::where('user_id', auth()->id())->where('id', request()->game_id)->first();
    }

    public function gameResult($game, $gameLog) {
        $trx  = getTrx();
        $user = $gameLog->user;

        if ($gameLog->win_status == Status::WIN) {
            $winBon     = $gameLog->invest * $game->win / 100;
            $amount     = $winBon;
            $investBack = 0;

            if ($game->invest_back == Status::YES) {
                $investBack = $gameLog->invest;
                $user->balance += $gameLog->invest;
                $user->save();

                $transaction               = new Transaction();
                $transaction->user_id      = $user->id;
                $transaction->amount       = $investBack;
                $transaction->charge       = 0;
                $transaction->trx_type     = '+';
                $transaction->details      = 'Invest Back For ' . $game->name;
                $transaction->remark       = 'invest_back';
                $transaction->trx          = $trx;
                $transaction->post_balance = $user->balance;
                $transaction->save();
            }

            $user->balance += $amount;
            $user->save();

            $gameLog->win_amo = $amount;
            $gameLog->save();

            $transaction               = new Transaction();
            $transaction->user_id      = $user->id;
            $transaction->amount       = $winBon;
            $transaction->charge       = 0;
            $transaction->trx_type     = '+';
            $transaction->details      = 'Win bonus of ' . $game->name;
            $transaction->remark       = 'Win_Bonus';
            $transaction->trx          = $trx;
            $transaction->post_balance = $user->balance;
            $transaction->save();

            $res['message'] = 'Yahoo! You Win!!!';
            $res['type']    = 'success';
        } else {
            $res['message'] = 'Oops! You Lost!!';
            $res['type']    = 'danger';
        }

        $res['result']      = $gameLog->result;
        $res['user_choose'] = $gameLog->user_select;
        $res['bal']         = showAmount($user->balance, currencyFormat: false);

        $gameLog->status = Status::GAME_FINISHED;
        $gameLog->save();

        return $res;
    }
}

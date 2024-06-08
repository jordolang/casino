<?php

namespace App\Http\Controllers\User;

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
        $game      = Game::active()->where('alias', $alias)->firstOrFail();
        $pageTitle = "Play " . $game->name;
        return view('Template::user.games.' . $alias, compact('game', 'pageTitle'));
    }

    public function investGame(Request $request, $alias) {
        $game = Game::active()->where('alias', $alias)->first();
        if (!$game) {
            return response()->json(['error' => 'Game not found']);
        }
        $aliasName  = str_replace('_', ' ', $alias);
        $methodName = 'play' . str_replace(' ', '', ucwords($aliasName));
        return $this->$methodName($game, $request);
    }

    public function gameEnd(Request $request, $alias) {
        $game = Game::active()->where('alias', $alias)->first();
        if (!$game) {
            return response()->json(['error' => 'Game not found']);
        }
        $aliasName  = str_replace('_', ' ', $alias);
        $methodName = 'gameEnd' . str_replace(' ', '', ucwords($aliasName));
        return $this->$methodName($game, $request);
    }

    public function playHeadTail($game, $request) {
        $validator = $this->investValidation($request, 'head,tail');

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $user = auth()->user();

        $fallback = $this->fallback($request, $user, $game);

        if (@$fallback['error']) {

            return response()->json($fallback);
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

        $res['game_id'] = $invest['game_log']->id;
        $res['balance'] = $user->balance;
        return response()->json($res);
    }

    public function gameEndHeadTail($game, $request) {
        $validator = $this->endValidation($request);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $gameLog = $this->runningGame();

        if (!$gameLog) {
            return response()->json(['error' => 'Game Logs not found']);
        }

        $res = $this->gameResult($game, $gameLog);

        return response()->json($res);
    }

    public function playRockPaperScissors($game, $request) {

        $validator = $this->investValidation($request, 'rock,paper,scissors');

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $user = auth()->user();

        $fallback = $this->fallback($request, $user, $game);

        if (@$fallback['error']) {
            return response()->json($fallback);
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

        $res['game_id'] = $invest['game_log']->id;
        $res['balance'] = $user->balance;
        return response()->json($res);
    }

    public function gameEndRockPaperScissors($game, $request) {
        $validator = $this->endValidation($request);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $gameLog = $this->runningGame();

        if (!$gameLog) {
            return response()->json(['error' => 'Game Logs not found']);
        }

        $res = $this->gameResult($game, $gameLog);

        return response()->json($res);
    }

    /*
     * Spin Wheel
     */

    public function playSpinWheel($game, $request) {
        $validator = $this->investValidation($request, 'red,blue');

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $user     = auth()->user();
        $fallback = $this->fallback($request, $user, $game);

        if (@$fallback['error']) {
            return response()->json($fallback);
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

        $res['game_id'] = $invest['game_log']->id;
        $res['invest']  = $request->invest;
        $res['result']  = $result;
        $res['balance'] = $user->balance;
        return response()->json($res);
    }

    public function gameEndSpinWheel($game, $request) {
        $validator = $this->endValidation($request);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $gameLog = $this->runningGame();

        if (!$gameLog) {
            return response()->json(['error' => 'Game Logs not found']);
        }

        $res = $this->gameResult($game, $gameLog);

        return response()->json($res);
    }

    /*
     * Number Guess
     */

    public function playNumberGuess($game, $request) {
        $validator = Validator::make($request->all(), [
            'invest' => 'required|numeric|gt:0',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $user = auth()->user();

        $fallback = $this->fallback($request, $user, $game);

        if (@$fallback['error']) {
            return response()->json($fallback);
        }

        $num = mt_rand(1, 100);

        $invest = $this->invest($user, $request, $game, $num, 0);

        $res['game_id'] = $invest['game_log']->id;
        $res['invest']  = $request->invest;
        $res['balance'] = $user->balance;

        return response()->json($res);
    }

    public function gameEndNumberGuess($game, $request) {

        $validator = Validator::make($request->all(), [
            'game_id' => 'required',
            'number'  => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        if ($request->number < 1 || $request->number > 100) {
            return response()->json(['error' => 'Enter a number between 1 and 100']);
        }

        $user    = auth()->user();
        $gameLog = $this->runningGame();

        if (!$gameLog) {
            return response()->json(['error' => 'Game Logs not found']);
        }

        if ($gameLog->user_select != null) {
            $userSelect = json_decode($gameLog->user_select);
            array_push($userSelect, $request->number);
        } else {
            $userSelect[] = $request->number;
        }

        $data  = GuessBonus::where('alias', $game->alias)->get();
        $count = $data->count();

        if ($gameLog->status == 1) {
            $mes['gameSt']  = 1;
            $mes['message'] = 'Time Over';
            return response()->json($mes);
        }

        $gameLog->try         = $gameLog->try + 1;
        $gameLog->user_select = json_encode($userSelect);

        if ($gameLog->try >= $count) {
            $gameLog->status = Status::ENABLE;
        }

        $gameLog->save();

        $bonus = GuessBonus::where('alias', $game->alias)->where('chance', $gameLog->try)->first()->percent;

        $amount = $gameLog->invest * $bonus / 100;

        $user = auth()->user();
        $game = Game::find($gameLog->game_id);

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

        if ($gameLog->status == 1) {
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
        return response()->json($mes);
    }

    /*
     * Dice Rolling
     */
    public function playDiceRolling($game, $request) {

        $validator = $this->investValidation($request, '1,2,3,4,5,6');

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $user = auth()->user();

        $fallback = $this->fallback($request, $user, $game);

        if (@$fallback['error']) {
            return response()->json($fallback);
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

        $res['game_id'] = $invest['game_log']->id;
        $res['result']  = $result;
        $res['balance'] = $user->balance;
        return response()->json($res);
    }

    public function gameEndDiceRolling($game, $request) {
        $validator = $this->endValidation($request);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $gameLog = $this->runningGame();

        if (!$gameLog) {
            return response()->json(['error' => 'Game Logs not found']);
        }

        $res = $this->gameResult($game, $gameLog);

        return response()->json($res);
    }

    /*
     * Card Finding
     */

    public function playCardFinding($game, $request) {

        $validator = $this->investValidation($request, 'black,red');

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $user = auth()->user();

        $fallback = $this->fallback($request, $user, $game);

        if (@$fallback['error']) {
            return response()->json($fallback);
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

        $res['game_id'] = $invest['game_log']->id;
        $res['result']  = $result;
        $res['balance'] = $user->balance;
        return response()->json($res);
    }

    public function gameEndCardFinding($game, $request) {
        $validator = $this->endValidation($request);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $gameLog = $this->runningGame();

        if (!$gameLog) {
            return response()->json(['error' => 'Game Logs not found']);
        }

        $res = $this->gameResult($game, $gameLog);

        return response()->json($res);
    }

    /*
     * Number Slot
     */

    public function PlayNumberSlot($game, $request) {
        $validator = $this->investValidation($request, '0,1,2,3,4,5,6,7,8,9');

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $user = auth()->user();

        $fallback = $this->fallback($request, $user, $game);

        if (@$fallback['error']) {
            return response()->json($fallback);
        }

        $random = mt_rand(1, 100);

        if ($game->probable_win[0] > $random) {
            $result = numberSlotResult(0, $request->choose);
            $win    = 0;
        } else if ($game->probable_win[0] + $game->probable_win[1] > $random) {
            $result = numberSlotResult(1, $request->choose);
            $win    = 1;
        } else if ($game->probable_win[0] + $game->probable_win[1] + $game->probable_win[2] > $random) {
            $result = numberSlotResult(2, $request->choose);
            $win    = 2;
        } else {
            $result = numberSlotResult(3, $request->choose);
            $win    = 3;
        }

        $invest = $this->invest($user, $request, $game, $result, $win);

        $res['game_id'] = $invest['game_log']->id;
        $res['number']  = $result;
        $res['win']     = $win;
        $res['balance'] = $user->balance;
        return response()->json($res);
    }

    public function gameEndNumberSlot($game, $request) {
        $validator = $this->endValidation($request);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $user    = auth()->user();
        $gameLog = $this->runningGame();

        if (!$gameLog) {
            return response()->json(['error' => 'Game Logs not found']);
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

        return response()->json($res);
    }

    /*
     * Pool Number
     */
    public function playNumberPool($game, $request) {
        $validator = $this->investValidation($request, '1,2,3,4,5,6,7,8');

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $user = auth()->user();

        $fallback = $this->fallback($request, $user, $game);

        if (@$fallback['error']) {
            return response()->json($fallback);
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

        $res['game_id'] = $invest['game_log']->id;

        $res['invest']  = $request->invest;
        $res['result']  = $result;
        $res['win']     = $win;
        $res['balance'] = $user->balance;
        return response()->json($res);
    }

    public function gameEndNumberPool($game, $request) {
        $validator = $this->endValidation($request);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $gameLog = $this->runningGame();

        if (!$gameLog) {
            return response()->json(['error' => 'Game Logs not found']);
        }

        $res = $this->gameResult($game, $gameLog);
        return response()->json($res);
    }

    public function investValidation($request, $in) {
        return Validator::make($request->all(), [
            'invest' => 'required|numeric|gt:0',
            'choose' => 'required|in:' . $in,
        ]);
    }

    public function fallback($request, $user, $game) {

        if ($request->invest > $user->balance) {
            return ['error' => 'Oops! You have no sufficient balance'];
        }

        $running = GameLog::where('status', 0)->where('user_id', $user->id)->where('game_id', $game->id)->first();

        if ($running) {
            return ['error' => '1 game is in-complete. Please wait'];
        }

        if ($request->invest > $game->max_limit) {
            return ['error' => 'Please follow the maximum limit of invest'];
        }

        if ($request->invest < $game->min_limit) {
            return ['error' => 'Please follow the minimum limit of invest'];
        }

        return ['success'];
    }

    public function endValidation($request) {
        return Validator::make($request->all(), [
            'game_id' => 'required',
        ]);
    }

    public function runningGame() {
        return GameLog::where('user_id', auth()->id())->where('id', request()->game_id)->first();
    }

    public function gameResult($game, $gameLog) {
        $trx  = getTrx();
        $user = auth()->user();

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

    public function rouletteSubmit(Request $request) {
        $validator = Validator::make($request->all(), [
            'invest' => 'required|numeric|gt:0',
            'choose' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }
        $game = Game::where('id', 9)->first();
        if (!$game) {
            return response()->json(['error' => 'Game Not Found']);
        }
        if ($request->invest < $game->min_limit) {
            return response()->json(['error' => 'Minimum invest limit is ' . showAmount($game->min_limit)]);
        }

        if ($request->invest > $game->max_limit) {
            return response()->json(['error' => 'Maximum invest limit is ' . showAmount($game->max_limit)]);
        }
        $amount = $request->invest;
        $user   = auth()->user();
        if ($amount > $user->balance) {
            return response()->json(['error' => 'Insufficient balance']);
        }

        $running = GameLog::where('user_id', $user->id)->where('game_id', 9)->where('status', Status::GAME_RUNNING)->first();
        if ($running) {
            return response()->json(['error' => 'You have an unfinished game. Please wait']);
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
        $winAmount         = $request->invest * (36 / count($numbers));
        $invest            = $this->invest($user, $request, $game, $random, $win, $winAmount); // random passed instead of number
        $res['gameLog_id'] = $invest['game_log']->id;
        $res['balance']    = showAmount($user->balance, currencyFormat: false);
        $res['result']     = $random;
        return response()->json($res);
    }

    public function rouletteResult(Request $request) {
        $validator = Validator::make($request->all(), [
            'gameLog_id' => 'required|integer',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }
        $user    = auth()->user();
        $gameLog = GameLog::where('user_id', $user->id)->where('id', $request->gameLog_id)->where('game_id', 9)->where('status', 0)->first();
        if (!$gameLog) {
            return response()->json(['error' => 'Game not found']);
        }

        $notification = 'Oops! You Lost!';
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
        }
        $gameLog->status = Status::GAME_FINISHED;
        $gameLog->save();

        return response()->json([
            'result'       => $gameLog->result,
            'win'          => $gameLog->win_status,
            'balance'      => showAmount($user->balance, currencyFormat: false),
            'notification' => $notification,
        ]);
    }

    public function diceSubmit(Request $request) {
        $validator = Validator::make($request->all(), [
            'percent' => 'required|numeric|gt:0',
            'invest'  => 'required|numeric|gt:0',
            'range'   => 'required|in:low,high',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }

        $user    = auth()->user();
        $running = GameLog::where('user_id', $user->id)->where('game_id', 10)->where('status', Status::GAME_RUNNING)->count();
        if ($running) {
            return response()->json(['error' => 'You have a unfinished game. please wait']);
        }
        $general = gs();
        $game    = Game::findOrFail(10);
        if ($request->invest < $game->min_limit) {
            return response()->json(['error' => 'Minimum invest limit is ' . showAmount($game->min_limit) . ' ' . $general->cur_text]);
        }
        if ($request->invest > $game->max_limit) {
            return response()->json(['error' => 'Maximum invest limit is ' . showAmount($game->max_limit) . ' ' . $general->cur_text]);
        }
        if ($request->invest > $user->balance) {
            return response()->json(['error' => 'Insufficient balance']);
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

        if ($win == 1) {
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
        return response()->json($res);
    }

    public function diceResult(Request $request) {
        $validator = Validator::make($request->all(), [
            'game_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }
        $user    = auth()->user();
        $gameLog = GameLog::where('user_id', $user->id)->where('id', $request->game_id)->where('status', Status::GAME_RUNNING)->first();

        if (!$gameLog) {
            return response()->json(['error' => 'Game not found']);
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
        $gameLog->status = 1;
        $gameLog->save();

        return response()->json([
            'result'  => $gameLog->result,
            'win'     => $gameLog->win_status,
            'balance' => showAmount($user->balance, currencyFormat: false),
        ]);
    }

    public function kenoSubmit(Request $request) {
        $validator = Validator::make($request->all(), [
            'invest' => 'required|numeric|gt:0',
            'choose' => 'required|array|min:1|max:80',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $user = auth()->user();

        $game = Game::active()->where('alias', 'keno')->first();
        if (!$game) {
            return response()->json(['errors' => 'Game not found']);
        }

        $fallback = $this->fallback($request, $user, $game);
        if (@$fallback['error']) {
            return response()->json($fallback);
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
        $res['game_log_id']  = $invest['game_log']->id;
        $res['user_select']  = json_decode($invest['game_log']->user_select);
        $res['match_number'] = $matchNumber;
        return response()->json($res);
    }

    public function kenoUpdate(Request $request) {
        $user    = auth()->user();
        $gameLog = GameLog::where('user_id', $user->id)->where('id', $request->gameLog_id)->first();
        if (!$gameLog) {
            return response()->json(['error' => 'Invalid game request']);
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

        return response()->json([
            'result' => json_decode($gameLog->result),
            'win'    => $gameLog->win_status,
        ]);
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
        return ['game_log' => $gameLog];
    }

    public function playBlackjack($game, $request) {
        $validator = Validator::make($request->all(), [
            'invest' => "required|numeric|gte:$game->min_limit",
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }
        $user     = auth()->user();
        $fallback = $this->fallback($request, $user, $game);

        if (@$fallback['error']) {
            return response()->json($fallback);
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

        $gameLog              = new GameLog();
        $gameLog->user_id     = $user->id;
        $gameLog->game_id     = $game->id;
        $gameLog->user_select = json_encode($cardImg);
        $gameLog->result      = json_encode($dealerResult);
        $gameLog->status      = 0;
        $gameLog->win_status  = 0;
        $gameLog->invest      = $request->invest;
        $gameLog->save();

        return response()->json([
            'dealerSum'      => $dealerSum,
            'dealerAceCount' => $dealerAceCount,
            'userSum'        => $userSum,
            'userAceCount'   => $userAceCount,
            'dealerCardImg'  => $dealerCardImg,
            'cardImg'        => $cardImg,
            'game_log_id'    => $gameLog->id,
            'balance'        => showAmount($user->balance, currencyFormat: false),
            'card'           => $deck,
        ]);
    }

    protected function getValue($card) {
        $data  = explode("-", $card);
        $value = $data[0];
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
            return response()->json(['error' => 'Game not found']);
        }
        $userSum      = $request->userSum;
        $userAceCount = $request->userAceCount;
        $reduceAce    = $this->reduceAce($userSum, $userAceCount);
        if ($reduceAce > 21) {
            return response()->json(['error' => 'You can\'t hit more']);
        }
        $deck      = $request->card;
        $card      = array_pop($deck);
        $cardImg[] = $card;
        $userSum += $this->getValue($card);
        $userAceCount += $this->checkAce($card);

        $oldCard              = json_decode($gameLog->user_select);
        $newCard              = array_merge($oldCard, [$card]);
        $gameLog->user_select = json_encode($newCard);
        $gameLog->save();

        return response()->json([
            'dealerAceCount' => $request->dealerAceCount,
            'userSum'        => $userSum,
            'userAceCount'   => $userAceCount,
            'cardImg'        => $cardImg,
            'game_log_id'    => $gameLog->id,
            'card'           => $deck,
        ]);
    }

    public function blackjackStay(Request $request) {
        $gameLog = GameLog::where('status', 0)->where('id', $request->game_log_id)->where('user_id', auth()->id())->first();
        if (!$gameLog) {
            return response()->json(['error' => 'Game not found']);
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

        $userAceCount   = $request->userAceCount;
        $dealerAceCount = $request->dealerAceCount;
        $hiddenImage    = $dealerSelectCard[0];

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

        return response()->json([
            'hiddenImage' => $hiddenImage,
            'win_status'  => $winStatus,
            'userSum'     => $userSum,
            'dealerSum'   => $dealerSum,
            'game_log_id' => $gameLog->id,
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
            return response()->json(['error' => 'Game not found']);
        }

        $game = $gameLog->game;

        if ($gameLog->invest > $user->balance) {
            return response()->json(['error' => 'Insufficient balance on you account']);
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

        return response()->json([
            'dealerSum'      => $dealerSum,
            'dealerAceCount' => $dealerAceCount,
            'userSum'        => $userSum,
            'userAceCount'   => $userAceCount,
            'dealerCardImg'  => $dealerCardImg,
            'cardImg'        => $cardImg,
            'game_log_id'    => $newGameLog->id,
            'balance'        => $user->balance,
            'card'           => $deck,
        ]);
    }

    public function playMines($game, $request) {
        $validator = Validator::make($request->all(), [
            'invest' => 'required|numeric|gte:0',
            'mines'  => 'required|integer|min:1|max:20',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $user = auth()->user();

        $fallback = $this->fallback($request, $user, $game);

        if (@$fallback['error']) {
            return response()->json($fallback);
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

        $res['game_log_id'] = $invest['game_log']->id;
        $res['balance']     = showAmount($user->balance, currencyFormat: false);
        $res['random']      = $random;
        return response()->json($res);
    }

    public function gameEndMines($game, $request) {
        $validator = $this->endValidation($request);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $gameLog = $this->runningGame();
        if (!$gameLog) {
            return response()->json(['error' => 'Game Logs not found']);
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
        $res['gold_count']       = $gameLog->gold_count;
        $res['mine_image']       = getImage(activeTemplate(true) . 'images/mines/mines.png');
        $res['gold_image']       = getImage(activeTemplate(true) . 'images/mines/gold.png');
        $res['gold_transparent'] = getImage(activeTemplate(true) . 'images/mines/gold_transparent.png');

        return response()->json($res);
    }

    public function mineCashout(Request $request) {
        $validator = Validator::make($request->all(), [
            'game_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $gameLog = $this->runningGame();

        if (!$gameLog) {
            return response()->json(['error' => 'Game Logs not found']);
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

        return response()->json([
            'balance' => showAmount($user->balance, currencyFormat: false),
            'sound'   => getImage('assets/audio/win.wav'),
            'success' => 'Congratulation! you won ' . getAmount($gameLog->win_amo) . ' ' . gs('cur_text'),
        ]);
    }

    public function playPoker($game, $request) {
        $validator = Validator::make($request->all(), [
            'invest' => 'required|numeric|gte:0',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $user = auth()->user();

        $fallback = $this->fallback($request, $user, $game);

        if (@$fallback['error']) {
            return response()->json($fallback);
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
        $res['message']     = getAmount($request->invest) . ' ' . gs('cur_text') . ' ' . 'betted successfully';
        return response()->json($res);
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
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $gameLog = $this->runningGame();

        if (!$gameLog) {
            return response()->json(['error' => 'Game Logs not found']);
        }
        $res['result'] = array_slice(json_decode($gameLog->result), 0, 3);
        $res['path']   = asset(activeTemplate(true) . '/images/cards/');
        return response()->json($res);
    }
    public function pokerCall(Request $request) {
        $validator = Validator::make($request->all(), [
            'game_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $gameLog = $this->runningGame();

        if (!$gameLog) {
            return response()->json(['error' => 'Game Logs not found']);
        }

        $rank = $this->hasSpecificHand(json_decode($gameLog->result));
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

            $user = $gameLog->user;
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
        $res['rank']   = str_replace("_", " ", $rank);
        $res['result'] = array_slice(json_decode($gameLog->result), 3, 5);
        $res['path']   = asset(activeTemplate(true) . '/images/cards/');
        return response()->json($res);
    }

    public function pokerFold(Request $request) {
        $validator = Validator::make($request->all(), [
            'game_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $gameLog = $this->runningGame();

        if (!$gameLog) {
            return response()->json(['error' => 'Game Logs not found']);
        }

        $gameLog->status = Status::GAME_FINISHED;
        $gameLog->save();

        $res['message'] = 'Oops! You Lost!!';
        $res['type']    = 'danger';
        $res['sound']   = getImage('assets/audio/lose.wav');
        $res['rank']    = 'no rank';
        return response()->json($res);
    }
}

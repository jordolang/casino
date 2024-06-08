<?php

namespace App\Http\Controllers\Admin;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\GameLog;
use App\Models\GuessBonus;
use App\Rules\FileTypeValidate;
use Illuminate\Http\Request;

class GameController extends Controller {
    public function index() {
        $pageTitle = "Games";
        $games     = Game::searchable(['name'])->orderBy('id', 'desc')->get();
        return view('admin.game.index', compact('pageTitle', 'games'));
    }

    public function edit($id) {
        $game      = Game::findOrFail($id);
        $pageTitle = "Update " . $game->name;

        $view    = 'game_edit';
        $bonuses = null;

        $alias = ['number_guess', 'number_slot', 'roulette', 'casino_dice', 'keno', 'blackjack', 'mines', 'poker'];
        if (in_array($game->alias, $alias)) {
            if (in_array($game->alias, ['number_guess', 'mines', 'poker'])) {
                $bonuses = GuessBonus::where('alias', $game->alias)->get();
            }
            $view = $game->alias;
        }
        // dd($game);
        return view('admin.game.' . $view, compact('pageTitle', 'game', 'bonuses'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'name'        => 'required',
            'min'         => 'required|numeric',
            'max'         => 'required|numeric',
            'instruction' => 'required',
            'win'         => 'sometimes|required|numeric',
            'invest_back' => 'sometimes|required',
            'trending'    => 'sometimes|required',
            'featured'    => 'sometimes|required',
            'probable'    => 'nullable|integer|max:100',
            'level.*'     => 'sometimes|required',
            'chance.*'    => 'sometimes|required|numeric',
            'image'       => ['nullable', new FileTypeValidate(['jpg', 'jpeg', 'png'])],
        ], [
            'level.0.required'  => 'Level 1 field is required',
            'level.1.required'  => 'Level 2 field is required',
            'level.2.required'  => 'Level 3 field is required',
            'chance.0.required' => 'No win chance field required',
            'chance.1.required' => 'Double win chance field is required',
            'chance.2.required' => 'Single win chance field is required',
            'chance.3.required' => 'Triple win field is required',
            'chance.*.numeric'  => 'Chance field must be a number',
        ]);
        $winChance = $request->probable;

        if (isset($request->chance)) {

            if (array_sum($request->chance) != 100) {
                $notify[] = ['error', 'The sum of winning chance must be equal of 100'];
                return back()->withNotify($notify);
            }

            $winChance = $request->chance;
        }

        $game = Game::findOrFail($id);

        $game->name         = $request->name;
        $game->min_limit    = $request->min;
        $game->max_limit    = $request->max;
        $game->probable_win = $winChance;
        $game->invest_back  = $request->invest_back ? Status::YES : Status::NO;
        $game->trending     = $request->trending ? Status::YES : Status::NO;
        $game->featured     = $request->featured ? Status::YES : Status::NO;
        $game->instruction  = $request->instruction;
        $game->short_desc   = $request->short_desc;
        $game->level        = $request->level;
        $game->win          = $request->win;

        $oldImage = $game->image;

        if ($request->hasFile('image')) {
            try
            {
                $game->image = fileUploader($request->image, getFilePath('game'), getFileSize('game'), $oldImage);
            } catch (\Exception $e) {
                $notify[] = ['error', 'Could not upload the Image.'];
                return back()->withNotify($notify);
            }
        }

        $game->save();

        $notify[] = ['success', 'Game updated successfully'];
        return back()->withNotify($notify);
    }

    public function gameLog(Request $request) {
        $pageTitle = "Game Logs";
        $logs      = GameLog::where('status', Status::ENABLE)->searchable(['user:username'])->filter(['win_status'])->with('user', 'game')->latest('id')->paginate(getPaginate());
        return view('admin.game.log', compact('pageTitle', 'logs'));
    }

    public function chanceCreate(Request $request, $alias = null) {

        $request->validate([
            'chance'    => 'required|array|min:1',
            'chance.*'  => 'required|integer|min:1',
            'percent'   => 'required|array',
            'percent.*' => 'required|numeric',
        ]);

        if ($request->alias == 'mines' && count($request->chance) != 20) {
            $notify[] = ['error', '20 mines commission is required'];
            return back()->withNotify($notify);
        }
        if ($request->alias == 'poker' && count($request->chance) != 10) {
            $notify[] = ['error', '10 rank commission is required'];
            return back()->withNotify($notify);
        }

        GuessBonus::where('alias', $request->alias)->delete();

        $data = [];
        for ($a = 0; $a < count($request->chance); $a++) {
            $data[] = [
                'alias'      => $alias,
                'chance'     => $request->chance[$a],
                'percent'    => $request->percent[$a],
                'status'     => Status::ENABLE,
                'created_at' => now(),
            ];
        }

        GuessBonus::insert($data);

        $notify[] = ['success', 'Chance bonus Create Successfully'];
        return back()->withNotify($notify);
    }

    public function status($id) {
        $game = Game::findOrFail($id);

        if ($game->status == Status::ENABLE) {
            $game->status = Status::DISABLE;
            $notify[]     = ['success', $game->name . ' disabled successfully'];
        } else {
            $game->status = Status::ENABLE;
            $notify[]     = ['success', $game->name . ' enabled successfully'];
        }

        $game->save();
        return back()->withNotify($notify);
    }

    public function kenoUpdate(Request $request, $id) {
        $request->validate([
            'name'              => 'required',
            'min'               => 'required|numeric',
            'max'               => 'required|numeric',
            'instruction'       => 'required',
            'invest_back'       => 'sometimes|required',
            'trending'          => 'sometimes|required',
            'featured'          => 'sometimes|required',
            'max_select_number' => 'required|integer|gte:4',
            'level.*'           => 'required|integer',
            'percent.*'         => 'required|numeric',
            'image'             => ['nullable', new FileTypeValidate(['jpg', 'jpeg', 'png'])],
        ], [
            'level.*.required'   => 'Level field is required',
            'percent.*.required' => 'Commission field required',
            'percent.*.numeric'  => 'Commission field must be a number',
        ]);

        $game      = Game::findOrFail($id);
        $maxSelect = [
            'max_select_number' => $request->max_select_number,
        ];
        for ($i = 0; $i < count($request->percent); $i++) {
            $level[] = [
                'level'   => $request->level[$i],
                'percent' => $request->percent[$i],
            ];
        }
        $levels['levels'] = $level;
        $levels           = array_merge($maxSelect, $levels);

        $game->name         = $request->name;
        $game->min_limit    = $request->min;
        $game->max_limit    = $request->max;
        $game->invest_back  = $request->invest_back ? Status::YES : Status::NO;
        $game->trending     = $request->trending ? Status::YES : Status::NO;
        $game->featured     = $request->featured ? Status::YES : Status::NO;
        $game->instruction  = $request->instruction;
        $game->level        = $levels;
        $game->probable_win = $request->probable;

        if ($request->hasFile('image')) {
            try
            {
                $game->image = fileUploader($request->image, getFilePath('game'), getFileSize('game'), @$game->image);
            } catch (\Exception $e) {
                $notify[] = ['error', 'Could not upload the Image.'];
                return back()->withNotify($notify);
            }
        }
        $game->save();

        $notify[] = ['success', 'Game updated successfully'];
        return back()->withNotify($notify);
    }
}

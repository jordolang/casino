<?php

namespace App\Models;

use App\Constants\Status;
use Illuminate\Database\Eloquent\Model;

class GameLog extends Model {

    protected $guarded = ['id'];

    public function game() {
        return $this->belongsTo(Game::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function scopeWin() {
        return $this->where('win_status', Status::WIN);
    }
    public function scopeLoss() {
        return $this->where('win_status', Status::LOSS);
    }
}

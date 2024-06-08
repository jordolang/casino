<?php

namespace App\Models;

use App\Traits\GlobalStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model {
    use HasFactory, GlobalStatus;

    protected $guarded = ['id'];

    protected $casts = [
        'level'        => 'object',
        'probable_win' => 'object',
    ];

}

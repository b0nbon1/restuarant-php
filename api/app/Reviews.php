<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reviews extends Model
{
    protected $fillable = [
        'review',
        'star',
        'food_id',
        'user_id',
    ];
}

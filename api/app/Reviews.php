<?php

namespace App;

use App\Food;
use App\User;

use Illuminate\Database\Eloquent\Model;

class Reviews extends Model
{
    protected $fillable = [
        'review',
        'star',
        'food_id',
        'user_id',
    ];
    public function food()
    {
        return $this->belongsTo(Food::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

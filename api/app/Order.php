<?php

namespace App;

use App\Food;
 use App\User;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'quantity',
        'food_id',
        'user_id',
    ];

    public function foods()
    {
        return $this->hasMany(Food::class,'order_details')->withPivot(['quantity']);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }
}

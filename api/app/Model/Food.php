<?php

namespace App\Model;

use App\Model\Category;
use App\Model\Review;
use App\Model\Cart;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{

        public function category()
        {
            return $this->belongsTo(Category::class);
        }
        public function reviews(){

            return $this->hasMany(Review::class);
        }
        public function carts(){

            return $this->belongsTo(Cart::class);
        }
        
}

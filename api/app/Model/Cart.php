<?php

namespace App\Model;

use App\Model\Food;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    public function foods(){

        return $this->hasMany(Food::class);
    }
}

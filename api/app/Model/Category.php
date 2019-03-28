<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Food;

class Category extends Model
{
    public function foods(){

        return $this->hasMany(Food::class);
    }
}

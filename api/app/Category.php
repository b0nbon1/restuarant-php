<?php

namespace App;
use App\Food;
use App\Http\Resources\food\FoodCollection;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'description'
    ];

    public function foods()
    {
        return $this->hasMany(Food::class);
    }
    public function getFoods($id)
    {
        return  new FoodCollection($this::find($id)->foods);
    }
}

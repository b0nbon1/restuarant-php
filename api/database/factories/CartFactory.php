<?php

use Faker\Generator as Faker;
use App\Model\Food;

$factory->define(App\Model\Cart::class, function (Faker $faker) {
    return [
        'description' => $faker->paragraph,
        'food_id'=> function(){
            return Food::all()->random();
        }
    ];
});

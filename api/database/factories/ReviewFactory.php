<?php

use Faker\Generator as Faker;
use App\Model\Food;

$factory->define(App\Model\Review::class, function (Faker $faker) {
    return [
        'customer'=> $faker ->word,
        'review'=> $faker ->paragraph,
        'star'=> $faker ->numberBetween(0,6),
        'food_id' => function(){
            return Food::all()->random();
        },
    ];
});

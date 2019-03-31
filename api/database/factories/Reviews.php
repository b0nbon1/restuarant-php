<?php

use App\Food;
use App\User;
use Faker\Generator as Faker;

$factory->define(App\Reviews::class, function (Faker $faker) {
    return [
        'review'=> $faker->paragraph,
        'star'=> $faker->numberBetween(0,5),
        'food_id' => function(){ return Food::all()->random();},
        'user_id' => function(){ return User::all()->random();}
    ];
});

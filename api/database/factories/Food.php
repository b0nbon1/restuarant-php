<?php

use App\Category;
use Faker\Generator as Faker;

$factory->define(App\Food::class, function (Faker $faker) {
    return [
        'name'=> $faker->word,
        'description'=> $faker->paragraph,
        'price'=> $faker->numberBetween(100, 1000),
        'discount'=> $faker->numberBetween(5,20),
        'category_id'=> function(){ return Category::all()->random();}
    ];
});

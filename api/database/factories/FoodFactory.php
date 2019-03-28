<?php

use Faker\Generator as Faker;
use App\Model\Category;

$factory->define(App\Model\Food::class, function (Faker $faker) {
    return [
        'name'=> $faker->word,
        'description'=> $faker ->paragraph,
        'price'=> $faker ->numberBetween(100, 100),
        'discount'=> $faker->numberBetween(2,30),
        'category_id'=> function(){
            return Category::all()->random();
        }
    ];
});

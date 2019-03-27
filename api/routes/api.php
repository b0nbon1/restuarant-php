<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::apiResource('/menu', 'MenuController');

Route::apiResource('/category', 'CategoryController');

Route::group(['prefix'=>'category'], function(){
    Route::apiResource('/{category}/food','FoodController');
});

Route::group(['prefix'=>'/food'], function(){
    Route::apiResource('/{food}/review','ReviewController');
});
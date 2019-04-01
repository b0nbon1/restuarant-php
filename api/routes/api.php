<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([
    'prefix' => 'auth'
        ], function () {
        Route::post('login', 'AuthController@login');
        Route::post('signup', 'AuthController@signup');
        Route::get('signup/activate/{token}', 'AuthController@signupActivate');
  
        Route::group([
        'middleware' => 'auth:api'
        ], function() {
            Route::get('logout', 'AuthController@logout');
            Route::get('user', 'AuthController@user');
            Route::patch('user','AuthController@user');
        });
});


Route::resource('category', 'CategoryController')->except(["create","index", "edit"]);
Route::get('category', 'CategoryController@index')->name('category.index');

Route::resource('food', 'FoodController')->except(["create","index", "edit"]);
Route::get('food', 'FoodController@index')->name('food.index');

Route::resource('order', 'OrderController')->except(["create","index", "edit"]);
Route::get('order', 'OrderController@index')->name('order.index');

Route::group(['prefix'=> 'food'],
    function (){
        Route::resource('/{food}/review', 'ReviewsController')->except(["create","index", "edit"]);
        Route::get('/{food}/review', 'ReviewsController@index')->name('review.index');
    }
);



Route::group([    
    'namespace' => 'Auth',    
    'middleware' => 'api',    
    'prefix' => 'password'
], function () {    
    Route::post('create', 'PasswordResetController@create');
    Route::get('find/{token}', 'PasswordResetController@find');
    Route::post('reset', 'PasswordResetController@reset');
});

Route::fallback(function(){
    return response()->json([
        'message' => 'Page Not Found. If error persists, contact info@website.com'], 404);
});

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


/* start auth routes*/
Route::group([
    'prefix' => 'auth',
    'middleware' => 'cors'
        ], function () {
        Route::post('login', 'AuthController@login');
        Route::post('signup', 'AuthController@signup');
        Route::get('signup/activate/{token}', 'AuthController@signupActivate');
  
        Route::group([
        'middleware' => 'auth:api'
        ], function() {
            Route::get('logout', 'AuthController@logout');
            Route::get('user', 'AuthController@user');
            Route::post('user/update','AuthController@updateUser');
            
        });
});

Route::group([    
    'namespace' => 'Auth',    
    'middleware' => ['api', 'cors'],    
    'prefix' => 'password'
], function () {    
    Route::post('create', 'PasswordResetController@create');
    Route::get('find/{token}', 'PasswordResetController@find');
    Route::post('reset', 'PasswordResetController@reset');
});

/*end auth routes*/

/*start admin routes */
Route::group([    
    'middleware' => ['api', 'cors', 'admin', 'auth:api'],
], function () { 
Route::post('category', 'CategoryController@store')->name('category.store');
Route::post('food', 'FoodController@store')->name('food.store');
Route::post('food/{food}', 'FoodController@update')->name('food.update');
Route::delete('food/{food}', 'FoodController@destroy')->name('food.destroy');
Route::patch('category/{category}', 'CategoryController@update')->name('category.update');
Route::delete('category/{category}', 'CategoryController@destroy')->name('category.destroy');
Route::get('order', 'OrderController@index')->name('order.index');
});
/*end admin routes*/

/*start authenticated routes */
Route::group([    
    'middleware' => ['api', 'cors', 'auth:api'],
], function () {
    Route::resource('order', 'OrderController')->except(["create","index", "edit"]);
    Route::resource('food/{food}/review', 'ReviewsController')->except(["create","index", "edit", "show"]);
     
});
/*end authenticated routes*/

/*start all users routes*/
Route::group([
        'middleware' => 'cors'
],
function (){
Route::get('category', 'CategoryController@index')->name('category.index');
Route::get('category/{category}', 'CategoryController@show')->name('category.show');
Route::get('food', 'FoodController@index')->name('food.index');
Route::get('food/{food}', 'FoodController@show')->name('food.show');
Route::get('food/{food}/review', 'ReviewsController@index')->name('review.index');
});
/*end all users routes*/

/*error handler*/
Route::fallback(function(){
    return response()->json([
        'message' => 'Page Not Found. If error persists, contact the admin for more info'], 404);
});

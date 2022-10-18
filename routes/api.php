<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['namespace'=> \App\Http\Controllers::class], function () {
    Route::group(['prefix' => 'cars'], function () {
        Route::get('/', 'CarController@getAll');
        Route::get('/unused', 'CarController@getUnusedCars');
        Route::get('/{id}', 'CarController@getById');
        Route::post('/',  'CarController@create');
        Route::post('/with/driver',  'CarController@createWithDriver');

        Route::delete('/{id}', 'CarController@destroy');
        Route::put('/', 'CarController@update');
    });

    Route::group(['prefix' =>'drivers'], function () {
        Route::get('/', 'DriverController@getAll');
        Route::get('/free', 'DriverController@getFreeDrivers');

        Route::get('/{id}', 'DriverController@getById');
        Route::post('/', 'DriverController@create');
        Route::delete('/{id}', 'DriverController@destroy');
        Route::put('/', 'DriverController@update');
    });
});





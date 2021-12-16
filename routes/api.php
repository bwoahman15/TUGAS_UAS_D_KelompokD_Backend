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

Route::post('register','Api\AuthController@register');
Route::post('login','Api\AuthController@login');

Route::get('user','Api\UserController@index');
Route::get('user/{id}','Api\UserController@show');
Route::post('user','Api\UserController@store');
Route::put('user/{id}','Api\UserController@update');
Route::delete('user/{id}','Api\UserController@destroy');

Route::get('makanan','Api\MakananController@index');
Route::get('makanan/{id}','Api\MakananController@show');
Route::post('makanan','Api\MakananController@store');
Route::put('makanan/{id}','Api\MakananController@update');
Route::delete('makanan/{id}','Api\MakananController@destroy');

Route::get('minuman','Api\MinumanController@index');
Route::get('minuman/{id}','Api\MinumanController@show');
Route::post('minuman','Api\MinumanController@store');
Route::put('minuman/{id}','Api\MinumanController@update');
Route::delete('minuman/{id}','Api\MinumanController@destroy');

Route::get('meja','Api\MejaController@index');
Route::get('meja/{id}','Api\MejaController@show');
Route::post('meja','Api\MejaController@store');
Route::put('meja/{id}','Api\MejaController@update');
Route::delete('meja/{id}','Api\MejaController@destroy');
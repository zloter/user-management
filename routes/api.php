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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('users', 'UserController@index')->name('users.get.all');
Route::get('users/{id}', 'UserController@get')->name('users.get');
Route::post('users', 'UserController@create')->name('users.create');
Route::put('users', 'UserController@update')->name('users.update');
Route::delete('users{id}', 'UserController@delete')->name('users.delete');


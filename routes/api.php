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

// Register
Route::post('/register', 'RegisterController@register');
// Login
Route::post('/login', 'LoginController@login');

// Session
Route::get('/session', 'SessionController@index');
Route::post('/session', 'SessionController@create')->middleware('jwt.verify');
Route::get('/session/{id}', 'SessionController@detail');
Route::put('/session/{id}', 'SessionController@update')->middleware('jwt.verify');
Route::delete('/session/{id}', 'SessionController@delete')->middleware('jwt.verify');



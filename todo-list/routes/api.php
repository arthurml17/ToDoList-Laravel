<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/************************** Routes User **************************/

Route::get('/user', 'App\Http\Controllers\UserController@index');
Route::get('/user/{id}', 'App\Http\Controllers\UserController@show');

Route::post('/user', 'App\Http\Controllers\UserController@store');

Route::delete('/user{id}', 'App\Http\Controllers\UserController@destroy');

/************************** End Routes User **************************/

/************************** Routes Tasks **************************/

Route::get('/task/{user_id}', 'App\Http\Controllers\TaskController@index');

Route::post('/task', 'App\Http\Controllers\TaskController@store');
Route::post('/task/show', 'App\Http\Controllers\TaskController@show');

Route::put('/task/{task_id}', 'App\Http\Controllers\TaskController@update');

/************************** End Routes Tasks **************************/


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

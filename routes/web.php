<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/car', 'App\Http\Controllers\CarController@index');
Route::get('/car/create', 'App\Http\Controllers\CarController@create');
Route::get('/car/update', 'App\Http\Controllers\CarController@update');
Route::get('/car/create_mg', 'App\Http\Controllers\CarController@create_mg');


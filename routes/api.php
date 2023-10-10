<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarController;
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

Route::middleware('auth:sanctum')->get('/user', function () {
    Route::get('user',[AuthController::class,'user']);;
});
Route::middleware('auth:sanctum')->get('getCarsInfo',[CarController::class,'getCarsInfo']);
Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('signUp',[AuthController::class,'register']);
    Route::post('signIn',[AuthController::class,'login']);
    
    

    
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});

Route::group(['namespace' => 'Cars', 'middleware' => 'jwt.auth'], function(){
    Route::get('getCarsInfo',[CarController::class,'getCarsInfo']);
    Route::get('getCarInfo',[CarController::class,'getCarInfo']);
});










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

Route::post('signUp',[AuthController::class,'signUp']);
Route::post('signIn',[AuthController::class,'signIn']);
Route::post('logout',[AuthController::class,'logout']);

Route::get('getCarInfo',[CarController::class,'getCarInfo']);



Route::get('getCarInfo',[CarController::class,'getCarInfo']);

<?php

use App\Http\Controllers\GoodController;
use App\Http\Controllers\JWTAuthController;
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

Route::post('register', [JWTAuthController::class, 'register']);
Route::post('login', [JWTAuthController::class, 'login']);
Route::get('goods', [GoodController::class, 'index']);

Route::group(['middleware' => 'auth.jwt'], function () {

    Route::post('logout', [JWTAuthController::class, 'logout']);
    Route::post('goods', [GoodController::class, 'store']);
    Route::get('goods/{id}', [GoodController::class, 'show']);
    Route::patch('goods/{id}', [GoodController::class, 'update']);
    Route::delete('goods/{id}', [GoodController::class, 'destroy']);

});

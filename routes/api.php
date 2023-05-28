<?php

use App\Api\v1\Http\Controllers\{
    UserController,
    TokenController,
    PositionController
};
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

Route::group(['prefix' => 'v1'], function () {
    Route::get('token', TokenController::class);

    Route::group(['middleware' => 'activeToken'], function () {
        Route::post('user', [UserController::class, 'store']);
    });

    Route::resource('users', UserController::class)->only('index', 'show');
    Route::get('positions', PositionController::class);
});

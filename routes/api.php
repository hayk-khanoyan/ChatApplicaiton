<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DirectMessageController;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\UserChatController;
use App\Http\Controllers\GroupMessageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SearchController;
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

Route::controller(UserAuthController::class)->group(function (): void {
    Route::post('login', 'login');
    Route::post('register', 'register');

    Route::middleware('auth:api')->group(function (): void {
        Route::post('logout', 'logout');
        Route::post('refresh', 'refresh');
    });
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [UserController::class, 'show']);

    Route::resource('group/{group_id}/messages', GroupMessageController::class);

    Route::resource('user/{user_id}/messages', DirectMessageController::class);

    Route::resource('message-history', UserChatController::class);

    Route::controller(SearchController::class)->prefix('search')->group(function () {
        Route::get('', 'search');
    });
});




<?php

declare(strict_types=1);

use App\Http\Controllers\CountryController;
use App\Http\Controllers\DirectMessageController;
use App\Http\Controllers\GroupMessageController;
use App\Http\Controllers\HobbyController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\UserChatController;
use App\Http\Controllers\UserController;
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

Route::get('countries', CountryController::class);
Route::get('hobbies', HobbyController::class);

Route::middleware('auth:api')->group(function (): void {
    Route::get('/user', [UserController::class, 'show']);

    Route::resource('group/{group_id}/messages', GroupMessageController::class);

    Route::resource('user/{user_id}/messages', DirectMessageController::class);

    Route::resource('chats', UserChatController::class);
    Route::get('chats/{chat_id}/messages', [UserChatController::class, 'chatMessages']);

    Route::controller(SearchController::class)->prefix('search')->group(function (): void {
        Route::get('', 'search');
    });
});

<?php

use App\Http\Controllers\MessageHistoryController;
use App\Http\Controllers\GroupMessageController;
use App\Http\Controllers\UserSearchController;
use App\Http\Controllers\UserMessageController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('group/{group_id}/messages', GroupMessageController::class);

Route::resource('user/{user_id}/messages', UserMessageController::class);

Route::resource('message-history', MessageHistoryController::class);

Route::controller(UserSearchController::class)->prefix('users')->group(function () {
    Route::get('search', 'search');
    Route::post('{user_id}/send_messages', 'search');
});

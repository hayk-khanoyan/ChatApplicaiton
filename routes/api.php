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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/get-channels', function () {
    $mockedChannels = [[
        "name" => 'Global chat',
        "participants" => 0,
        "id" => 1,
    ], [
        "name" => 'Funny',
        "participants" => 0,
        "id" => 2,
    ],];
    return response()->json(['channels' => $mockedChannels]);
});

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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::group([], function(){
    Route::get('/user/me', [\App\Http\Controllers\Api\UserController::class, 'me'])->name('users.me');
    Route::get('/users', [\App\Http\Controllers\Api\UserController::class, 'index'])->name('users.index');

    Route::get('/messages/{user}', [\App\Http\Controllers\Api\MessageController::class, 'listMessages'])->name('messages.listMessages');
    Route::post('/messages/store', [\App\Http\Controllers\Api\MessageController::class, 'store'])->name('messages.store');
    Route::post('/notifications/store', [\App\Http\Controllers\Api\NotificationController::class, 'store'])->name('notifications.store');
});

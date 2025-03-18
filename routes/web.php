<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::get('/index', [ChatController::class, 'index'])->name('index');
    Route::get('/messages/{userID}', [ChatController::class, 'showMessages'])->name('show.messages');
    Route::post('/send-message', [ChatController::class, 'sendMessage'])->name('send-message');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

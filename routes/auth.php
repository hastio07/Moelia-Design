<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest:admins,web')->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::get('register', 'create')->name('register');
        Route::post('register', 'store');
        Route::get('login', 'index')->name('login');
        Route::post('login', 'authenticate');
    });
});

Route::middleware('auth:admins')->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::post('logout', 'destroy')->name('logout');
    });
});

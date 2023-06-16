<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest:admins,web')->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::get('register', 'create')->name('register');
        Route::post('register', 'store');

        Route::get('login', 'index')->name('login');
        Route::post('login', 'authenticate');

        Route::get('forgot-password', 'forgotpassword')->name('password.request');
        Route::post('forgot-password', 'sendresetlinkforgotpassword')->name('password.email');

        Route::get('reset-password/{token?}', 'passwordreset')->name('password.reset');
        Route::post('reset-password', 'passwordupdate')->name('password.store');

    });
});

Route::middleware('auth:admins')->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::post('logout', 'destroy')->name('logout');
    });
});

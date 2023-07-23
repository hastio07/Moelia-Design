<?php

use App\Http\Controllers\admin\ManagePesananProsesController;
use Illuminate\Support\Facades\Route;

Route::post('payments/midtrans-notification', [ManagePesananProsesController::class, 'callback']);

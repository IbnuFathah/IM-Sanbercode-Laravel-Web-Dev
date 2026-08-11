<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FormController;

Route::get('/', [DashboardController::class, 'utama']);
Route::get('/daftar', [FormController::class, 'daftar']);
Route::post('/kirim', [FormController::class, 'submit']);

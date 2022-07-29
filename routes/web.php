<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\UserController::class, 'create'])->name('create');
Route::post('/store', [\App\Http\Controllers\UserController::class, 'store'])->name('store');

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\AuthController;

Route::get('/', [IndexController::class, 'index']);
Route::get('/register', [AuthController::class, 'create']);
Route::post('/register/user', [AuthController::class, 'store']);
Route::get('/logout', [AuthController::class, 'logout']);

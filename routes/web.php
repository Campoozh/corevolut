<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;

/* INDEX */
Route::get('/', [IndexController::class, 'index']);

/* User Register */
Route::get('/register', [AuthController::class, 'create']);
Route::post('/user/register', [AuthController::class, 'store']);

/* User Login/Logout */
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/user/login', [AuthController::class, 'authenticate']);
Route::get('/logout', [AuthController::class, 'logout']);

/* User Profile */
Route::get('/user/{url_id}', [ProfileController::class, 'show']);

/* Profile interactions */
Route::middleware('auth')->prefix('user')->group(function (){
    Route::put('/edit_image/{id}', [ProfileController::class, 'updateImage']); 
    Route::get('/edit_image/{id}', [ProfileController::class, 'updateImage']); 
    Route::put('/update_profile/{id}', [ProfileController::class, 'updateProfile']); 
    Route::get('/update_profile/{id}', [ProfileController::class, 'updateProfile']); 
    Route::post('/follow/{id}', [ProfileController::class, 'follow']);
    Route::get('/follow/{id}', [ProfileController::class, 'follow']);
});


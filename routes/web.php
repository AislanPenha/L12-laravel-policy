<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function(){
    Route::view('/login', 'auth.login')->name('login');
    Route::get('/login/{id}', [AuthController::class, 'login_user'])->name('login_user');
});

Route::middleware('auth')->group(function(){
    Route::redirect('/', '/home');
    Route::get('/home', [MainController::class, 'index'])->name('home');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/post_create', [AuthController::class, 'create'])->name('post_create');

    Route::get('/post_update/{id}', [AuthController::class, 'update'])->name('post_update');
    Route::get('/post_delete/{id}', [AuthController::class, 'delete'])->name('post_delete');
});

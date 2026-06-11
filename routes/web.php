<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

//Halaman Utama
Route::get('/',[AuthController::class,'showLogin'])->name('login');
Route::post('/login',[AuthController::class,'login'])->name('login.process');
Route::post('/logout',[AuthController::class,'logout'])->name('logout');

//Protect Halaman login
Route::middleware('auth')->group(function(){
    Route::resource('products', ProductController::class);
});
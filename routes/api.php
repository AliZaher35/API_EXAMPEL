<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\HTTP\Controllers\PassportAuthController;
use App\Http\Controllers\ProductController;



Route::post('register', [PassportAuthController::class,'register'])->name('register');
Route::post('login', [PassportAuthController::class,'login'])->name('login');
Route::middleware(['auth:api'])->group(function(){

    Route::get('userinfo',[PassportAuthController::class,'Userinfo']);
    Route::resource('Product',ProductController::class);
});
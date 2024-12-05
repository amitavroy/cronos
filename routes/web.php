<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserSettingController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('do-login');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', HomeController::class)->name('home');
    Route::post('/logout', LogoutController::class)->name('logout');

    Route::get('/user/profile', [UserSettingController::class, 'show'])->name('user-profile.show');
    Route::post('/user/profile', [UserSettingController::class, 'update'])->name('user-profile.update');
    Route::resource('/user', UserController::class);

    Route::resource('/product', ProductController::class);
});

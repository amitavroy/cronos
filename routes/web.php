<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('do-login');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', HomeController::class)->name('home');
});

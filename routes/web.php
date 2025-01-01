<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\Notification\MarkNotificationReadController;
use App\Http\Controllers\Notification\NotificationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PrivateImageController;
use App\Http\Controllers\SegmentController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('do-login');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', HomeController::class)->name('home');
    Route::post('/logout', LogoutController::class)->name('logout');

    Route::resource('/customer', CustomerController::class)->only(['index', 'show']);
    Route::resource('/order', OrderController::class)->only(['index', 'show']);

    Route::resource('/segment', SegmentController::class);

    Route::resource('/notification', NotificationController::class)->only(['index', 'create', 'store', 'destroy']);
    Route::post('/notification/mark-read', MarkNotificationReadController::class)->name('notification.mark-read');

    Route::get('/private-image', PrivateImageController::class)->name('private-image');
});

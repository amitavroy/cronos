<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\Notification\MarkNotificationReadController;
use App\Http\Controllers\Notification\NotificationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductImageUploadController;
use App\Http\Controllers\ProfilePicUploadController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserPasswordChangeController;
use App\Http\Controllers\UserSettingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('do-login');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', HomeController::class)->name('home');
    Route::post('/logout', LogoutController::class)->name('logout');
    
    Route::resource('/customer', CustomerController::class)->only(['index', 'show']);
    Route::resource('/order', OrderController::class)->only(['index', 'show']);

    Route::resource('/notification', NotificationController::class)->only(['index', 'create', 'store', 'destroy']);
    Route::post('/notification/mark-read', MarkNotificationReadController::class)->name('notification.mark-read');
});

Route::get('/private-image', function (Request $request) {
    if (!$request->has('filename')) {
        abort(404);
    }

    $filename = $request->input('filename');
    $path = storage_path('app/private/' . $filename);
    if (!Storage::exists($filename)) {
        abort(404);
    }

    return response()->file($path);
})->middleware('auth')->name('private-image');

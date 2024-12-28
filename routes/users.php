<?php

use App\Http\Controllers\ProfilePicUploadController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserPasswordChangeController;
use App\Http\Controllers\UserSettingController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth'], function () {
    Route::get('/user/profile', [UserSettingController::class, 'show'])
        ->name('user-profile.show');

    Route::post('/user/profile', [UserSettingController::class, 'update'])
        ->name('user-profile.update');

    Route::post('/user/password-change', UserPasswordChangeController::class)
        ->name('user.password.change');

    Route::post('/user/profile-pic-upload', ProfilePicUploadController::class)
        ->name('user.profile-pic.upload');

    Route::resource('/user', UserController::class);
});

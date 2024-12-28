<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductImageUploadController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth'], function () {
    Route::resource('/product', ProductController::class);

    Route::post('/product/feature-image/{product}', [ProductImageUploadController::class, 'store'])
        ->name('product.add-feature-image');

    Route::delete('/product/feature-image/{product}', [ProductImageUploadController::class, 'destroy'])
        ->name('product.remove-feature-image');
});

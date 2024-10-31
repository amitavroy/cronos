<?php

use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return inertia('Home');
});

Route::resource('/todo', TodoController::class)
    ->only(['store', 'index']);

<?php

use App\Http\Controllers\PasswordController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home', ['password' => null]);
});

Route::post('/', [PasswordController::class, 'get']);
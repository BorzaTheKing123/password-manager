<?php

use App\Http\Controllers\DomainController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home', ['password' => null]);
});

Route::post('/', [DomainController::class, 'get']);
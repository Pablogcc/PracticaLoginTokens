<?php

use App\Http\Controllers\LoginController;
use App\Http\Middleware\CheckLogin;
use App\Http\Middleware\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/login', [LoginController::class, 'login']);

Route::middleware(CheckLogin::class)->get('/me', [LoginController::class, 'whoAmI']);

 Route::middleware(CheckLogin::class)->post('/logout', [LoginController::class, 'logout']);

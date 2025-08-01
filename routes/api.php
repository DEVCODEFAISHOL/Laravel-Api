<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [App\Http\Controllers\AuthController::class, 'register'])
    ->name('register');
Route::post('/login', [App\Http\Controllers\AuthController::class, 'login'])
    ->name('login');

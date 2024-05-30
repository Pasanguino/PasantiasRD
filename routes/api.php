<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Sanctum\Sanctum;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('products',[ProductController::class, 'index']);
Route::post('register',[AuthController::class, 'register']);
Route::post('login',[AuthController::class, 'login']);

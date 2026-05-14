<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\AuthController;

// ログインAPI
Route::post('/login', [AuthController::class, 'login']);

// 認証必要API
Route::middleware('auth:sanctum')->group(function () {

    Route::post('/products/{product}/purchase',
        [ProductController::class, 'purchase']);

});
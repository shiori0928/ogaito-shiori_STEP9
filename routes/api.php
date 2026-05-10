<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;

Route::post('/products/{product}/purchase', [ProductController::class, 'purchase']);

Route::get('/test', function () {
    return 'OK';
});
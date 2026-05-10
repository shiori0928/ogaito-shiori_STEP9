<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\MyPageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AccountController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/mypage', [MyPageController::class, 'index'])->name('mypage.index');

    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');

    // 🔽 ここ追加（edit と destroy）
    Route::get('/products/{product}/edit',
        [ProductController::class, 'edit'])
        ->name('products.edit');

    Route::delete('/products/{product}',
        [ProductController::class, 'destroy'])
        ->name('products.destroy');

    Route::get('/mypage/products/{product}', 
        [ProductController::class, 'myShow'])
        ->name('mypage.products.show');

    Route::put('/products/{product}',
        [ProductController::class, 'update'])
        ->name('products.update'); 
});

Route::get('/products', [ProductController::class, 'index'])
    ->name('products.index');

Route::get('/products/{product}/purchase',
    [ProductController::class, 'purchaseForm'])
    ->name('products.purchase');

Route::post('/products/{product}/purchase',
    [ProductController::class, 'purchase'])
    ->name('products.purchase.store')
    ->middleware('auth');

Route::get('/products/{product}', [ProductController::class, 'show'])
    ->name('products.show');

Route::get('/account/edit', [AccountController::class, 'edit'])
    ->middleware('auth')
    ->name('account.edit');

Route::put('/account', [AccountController::class, 'update'])
    ->name('account.update');

Route::get('/contact', function () {
        return view('contact');
    })->name('contact');

    
Route::post('/favorite/toggle', [ProductController::class, 'toggleFavorite'])
    ->name('favorite.toggle')
    ->middleware('auth');


require __DIR__.'/auth.php';
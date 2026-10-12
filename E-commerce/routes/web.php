<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\Admin\ProductController;

// Customer side
Route::get('/', [ShopController::class, 'home'])->name('home');
Route::get('/shop', [ShopController::class, 'index'])->name('shop');
Route::get('/shop/{product}', [ShopController::class, 'show'])->name('shop.show');

// Admin side (product CRUD)
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('products', ProductController::class);
});
?>
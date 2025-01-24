<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/dashboard');  // Mengarahkan ke dashboard setelah login
});

require __DIR__.'/auth.php';

Route::middleware(['auth'])->group(function () {
    
    // Home route
    Route::get('/dashboard', [ProductController::class, 'index'])->name('dashboard');

    // Route untuk produk yang bisa digunakan untuk index, create, edit, dan delete produk
    Route::resource('products', ProductController::class);

    // Profile routes
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::post('/profile/update-password', [ProfileController::class, 'updatePassword'])->name('profile.update-password');

    // Route tambahan untuk menurunkan atau menaikkan stok produk
    Route::post('/products/{product}/decrease', [ProductController::class, 'decrease'])->name('products.decrease');
    Route::post('/products/{product}/increase', [ProductController::class, 'increase'])->name('products.increase');

    // Route untuk kategori
    Route::resource('categories', CategoryController::class);
});


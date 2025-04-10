<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

    Route::prefix('products')->group(function (){
        Route::get('/', [ProductController::class, 'index'])->name('products');
        Route::post('store', [ProductController::class, 'store'])->name('product.store');
        Route::delete('{id}/destroy', [ProductController::class, 'destroy'])->name('product.destroy');
        Route::get('{id}/edit', [ProductController::class, 'edit'])->name('product.edit');
        Route::post('{id}/update', [ProductController::class, 'update'])->name('product.update');

    });

    
});

require __DIR__.'/auth.php';

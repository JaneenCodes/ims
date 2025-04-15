<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');




    

    Route::prefix('products')->group(function (){
        Route::get('/', [ProductController::class, 'index'])->name('products');
        Route::get('list', [ProductController::class, 'list'])->name('product.list');
        Route::post('store', [ProductController::class, 'store'])->name('product.store');
        Route::delete('{product}/destroy', [ProductController::class, 'destroy'])->name('product.destroy');
        Route::get('{id}/edit', [ProductController::class, 'edit'])->name('product.edit');
        Route::post('{product}/update', [ProductController::class, 'update'])->name('product.update');
        Route::post('{id}/restock', [ProductController::class, 'restock'])->name('product.restock');
        Route::post('{id}/deduct', [ProductController::class, 'deduct'])->name('product.deduct');


    });

    
});

require __DIR__.'/auth.php';

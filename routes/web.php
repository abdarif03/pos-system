<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

use App\Http\Controllers\ProductController;

Route::get('/', fn () => redirect()->route('dashboard'))->name('home');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Route::resource('products', ProductController::class);
Route::prefix('products')->group(function () {
    Route::get('', [ProductController::class, 'index'])->name('products.index');
    Route::get('create', [ProductController::class, 'create'])->name('products.create');
    Route::post('store', [ProductController::class, 'store'])->name('products.store');
    Route::get('edit/{product}', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('update/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('destroy/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
});

Route::prefix('transactions')->group(function () {
    Route::get('', [TransactionController::class, 'index'])->name('transactions.index');
    Route::get('create', [TransactionController::class, 'create'])->name('transactions.create');
    Route::post('store', [TransactionController::class, 'store'])->name('transactions.store');
    Route::get('detail', [TransactionController::class, 'detail'])->name('transactions.detail');
});

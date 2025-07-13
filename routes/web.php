<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfitController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;

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
    
    // Status management routes
    Route::patch('{id}/mark-as-paid', [TransactionController::class, 'markAsPaid'])->name('transactions.mark-as-paid');
    Route::patch('{id}/cancel', [TransactionController::class, 'cancel'])->name('transactions.cancel');
    Route::patch('{id}/mark-as-expired', [TransactionController::class, 'markAsExpired'])->name('transactions.mark-as-expired');
});

Route::prefix('reports')->group(function () {
    Route::get('', [ReportController::class, 'index'])->name('reports.index');
    // Route::get('print', [TransactionController::class, 'print'])->name('reports.print');
});

// Profit Routes
Route::prefix('profits')->group(function () {
    Route::get('', [ProfitController::class, 'index'])->name('profits.index');
    Route::get('daily', [ProfitController::class, 'daily'])->name('profits.daily');
    Route::get('weekly', [ProfitController::class, 'weekly'])->name('profits.weekly');
    Route::get('monthly', [ProfitController::class, 'monthly'])->name('profits.monthly');
    Route::get('yearly', [ProfitController::class, 'yearly'])->name('profits.yearly');
});

// Settings Routes
Route::resource('users', UserController::class);
Route::resource('roles', RoleController::class);
Route::resource('categories', CategoryController::class);

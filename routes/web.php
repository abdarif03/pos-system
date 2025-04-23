<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

use App\Http\Controllers\ProductController;

Route::get('/', fn () => redirect()->route('dashboard'))->name('home');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('products', ProductController::class);

use App\Http\Controllers\TransactionController;

Route::resource('transactions', TransactionController::class)->only(['index', 'create', 'store']);

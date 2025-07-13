<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfitController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Protected Routes (require authentication)
Route::middleware('auth')->group(function () {
    Route::get('/', fn () => redirect()->route('dashboard'))->name('home');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Products - Admin and Cashier only
    Route::middleware('role:admin,cashier')->prefix('products')->group(function () {
        Route::get('', [ProductController::class, 'index'])->name('products.index');
        Route::get('create', [ProductController::class, 'create'])->name('products.create');
        Route::post('store', [ProductController::class, 'store'])->name('products.store');
        Route::get('edit/{product}', [ProductController::class, 'edit'])->name('products.edit');
        Route::put('update/{product}', [ProductController::class, 'update'])->name('products.update');
        Route::delete('destroy/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
    });

    // Transactions - All roles can view, Admin and Cashier can create
    Route::prefix('transactions')->group(function () {
        Route::get('', [TransactionController::class, 'index'])->name('transactions.index');
        Route::get('detail', [TransactionController::class, 'detail'])->name('transactions.detail');
        
        // Create transaction - Admin and Cashier only
        Route::middleware('role:admin,cashier')->group(function () {
            Route::get('create', [TransactionController::class, 'create'])->name('transactions.create');
            Route::post('store', [TransactionController::class, 'store'])->name('transactions.store');
        });
        
        // Status management routes - Admin and Cashier only
        Route::middleware('role:admin,cashier')->group(function () {
            Route::post('{id}/mark-as-paid', [TransactionController::class, 'markAsPaid'])->name('transactions.mark-as-paid');
            Route::post('{id}/cancel', [TransactionController::class, 'cancel'])->name('transactions.cancel');
            Route::post('{id}/mark-as-expired', [TransactionController::class, 'markAsExpired'])->name('transactions.mark-as-expired');
        });
    });

    // Reports - All roles can view
    Route::prefix('reports')->group(function () {
        Route::get('', [ReportController::class, 'index'])->name('reports.index');
        // Route::get('print', [TransactionController::class, 'print'])->name('reports.print');
    });

    // Profit Routes - Admin and Cashier only
    Route::middleware('role:admin,cashier')->prefix('profits')->group(function () {
        Route::get('', [ProfitController::class, 'index'])->name('profits.index');
        Route::get('daily', [ProfitController::class, 'daily'])->name('profits.daily');
        Route::get('weekly', [ProfitController::class, 'weekly'])->name('profits.weekly');
        Route::get('monthly', [ProfitController::class, 'monthly'])->name('profits.monthly');
        Route::get('yearly', [ProfitController::class, 'yearly'])->name('profits.yearly');
    });

    // Settings Routes - Admin only
    Route::middleware('role:admin')->group(function () {
        Route::resource('users', UserController::class);
        Route::resource('roles', RoleController::class);
        Route::resource('categories', CategoryController::class);
    });
});

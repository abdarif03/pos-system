<?php

use App\Http\Controllers\Manage\DashboardController;
use App\Http\Controllers\Manage\UserAccessController;
use App\Http\Controllers\Manage\ClientController;
use App\Http\Controllers\Manage\PaymentController;
use App\Http\Controllers\Manage\AuthController;
use Illuminate\Support\Facades\Route;

// Authentication Routes for Manage System
Route::get('/', function () {
    if (\Illuminate\Support\Facades\Auth::check()) {
        return redirect()->route('manage.dashboard');
    }
    return redirect()->route('manage.login');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('manage.login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('manage.logout');

// Protected Routes (require authentication)
Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('manage.dashboard');
    
    // User Access Management
    Route::prefix('users')->group(function () {
        Route::get('', [UserAccessController::class, 'index'])->name('manage.users.index');
        Route::get('create', [UserAccessController::class, 'create'])->name('manage.users.create');
        Route::post('store', [UserAccessController::class, 'store'])->name('manage.users.store');
        Route::get('edit/{user}', [UserAccessController::class, 'edit'])->name('manage.users.edit');
        Route::put('update/{user}', [UserAccessController::class, 'update'])->name('manage.users.update');
        Route::delete('destroy/{user}', [UserAccessController::class, 'destroy'])->name('manage.users.destroy');
    });
    
    // Client Management
    Route::prefix('clients')->group(function () {
        Route::get('', [ClientController::class, 'index'])->name('manage.clients.index');
        Route::get('create', [ClientController::class, 'create'])->name('manage.clients.create');
        Route::post('store', [ClientController::class, 'store'])->name('manage.clients.store');
        Route::get('show/{client}', [ClientController::class, 'show'])->name('manage.clients.show');
        Route::get('edit/{client}', [ClientController::class, 'edit'])->name('manage.clients.edit');
        Route::put('update/{client}', [ClientController::class, 'update'])->name('manage.clients.update');
        Route::delete('destroy/{client}', [ClientController::class, 'destroy'])->name('manage.clients.destroy');
        Route::post('{client}/activate', [ClientController::class, 'activate'])->name('manage.clients.activate');
        Route::post('{client}/deactivate', [ClientController::class, 'deactivate'])->name('manage.clients.deactivate');
    });
    
    // Payment Management
    Route::prefix('payments')->group(function () {
        Route::get('', [PaymentController::class, 'index'])->name('manage.payments.index');
        Route::get('create', [PaymentController::class, 'create'])->name('manage.payments.create');
        Route::post('store', [PaymentController::class, 'store'])->name('manage.payments.store');
        Route::get('show/{payment}', [PaymentController::class, 'show'])->name('manage.payments.show');
        Route::get('edit/{payment}', [PaymentController::class, 'edit'])->name('manage.payments.edit');
        Route::put('update/{payment}', [PaymentController::class, 'update'])->name('manage.payments.update');
        Route::delete('destroy/{payment}', [PaymentController::class, 'destroy'])->name('manage.payments.destroy');
        Route::post('{payment}/approve', [PaymentController::class, 'approve'])->name('manage.payments.approve');
        Route::post('{payment}/reject', [PaymentController::class, 'reject'])->name('manage.payments.reject');
        Route::get('export', [PaymentController::class, 'export'])->name('manage.payments.export');
    });
});

// Redirect all other routes to login if not authenticated
Route::fallback(function () {
    if (!\Illuminate\Support\Facades\Auth::check()) {
        return redirect()->route('manage.login');
    }
    abort(404);
}); 
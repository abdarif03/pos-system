<?php

use App\Http\Controllers\Web\ClientRegistrationController;
use App\Http\Controllers\WebProfileController;
use Illuminate\Support\Facades\Route;

// Web Profile Routes (www.pos-system.test and pos-system.test)
$webRoutes = function () {
    Route::get('/', [WebProfileController::class, 'index'])->name('home');
    Route::get('/features', [WebProfileController::class, 'features'])->name('features');
    Route::get('/pricing', [WebProfileController::class, 'pricing'])->name('pricing');
    Route::get('/about', [WebProfileController::class, 'about'])->name('about');
    Route::get('/contact', [WebProfileController::class, 'contact'])->name('contact');
    Route::get('/demo', [WebProfileController::class, 'demo'])->name('demo');

    Route::get('/daftar', [ClientRegistrationController::class, 'create'])->name('client.register');
    Route::post('/daftar', [ClientRegistrationController::class, 'store'])->name('client.register.store');
    Route::get('/daftar/selesai', [ClientRegistrationController::class, 'thanks'])->name('client.register.thanks');
};

Route::domain('www.pos-system.test')->group($webRoutes);
Route::domain('pos-system.test')->group($webRoutes);

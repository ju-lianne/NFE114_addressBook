<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/inscription', [AuthController::class, "showRegisterForm"])->name('register');
    Route::post('/inscription', [AuthController::class, 'register'])->name('register.post');

    Route::get('/connexion', [AuthController::class, "showLoginForm"])->name('login');
    Route::post('/connexion', [AuthController::class, 'login'])->name('login.post');
});

Route::post('/deconnexion', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

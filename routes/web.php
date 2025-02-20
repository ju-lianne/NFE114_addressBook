<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('dashboard');

Route::get('/inscription', [AuthController::class, "showRegisterForm"])->name('register');
Route::post('/inscription', [AuthController::class, 'register'])->name('register.post');

Route::get('/connexion', [AuthController::class, "showLoginForm"])->name('login');
Route::post('/connexion', [AuthController::class, 'login'])->name('login.post');
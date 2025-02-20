<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/register', [AuthController::class, "showRegisterForm"]);
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
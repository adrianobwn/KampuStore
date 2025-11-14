<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\Auth\PasswordResetLinkController;

// Auth
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.perform');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.perform');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Products
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product:slug}', [ProductController::class, 'show'])->name('products.show');

// Reviews (auth required)
Route::middleware('auth')->group(function () {
    Route::post('/products/{product:slug}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
});

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

// Landing page
Route::get('/', function () {
    return view('home');   // resources/views/home.blade.php
})->name('home');

// (opsional) kalau mau url /home juga bisa
Route::get('/home', function () {
    return redirect()->route('home');
});

// Market: langsung ke katalog produk
Route::get('/market', function () {
    return redirect()->route('products.index');
})->name('market');

// Forgot password (minta link reset via email)
Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
    ->middleware('guest')
    ->name('password.request');

Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
    ->middleware('guest')
    ->name('password.email');


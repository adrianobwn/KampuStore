<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Admin\SellerRegistrationController;
use App\Http\Controllers\Admin\SellerVerificationController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\ReportController;


/*
|--------------------------------------------------------------------------
| Auth
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.perform');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.perform');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Products & Reviews
|--------------------------------------------------------------------------
*/
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product:slug}', [ProductController::class, 'show'])->name('products.show');

// Reviews (SRS-MartPlace-06 - allow guest reviews)
Route::post('/products/{product:slug}/reviews', [ReviewController::class, 'store'])
    ->name('reviews.store');

/*
|--------------------------------------------------------------------------
| Landing / Utility
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('home');   // resources/views/home.blade.php
})->name('home');

Route::get('/home', function () {
    return redirect()->route('home');
});

Route::get('/market', function () {
    return redirect()->route('products.index');
})->name('market');

/*
|--------------------------------------------------------------------------
| Forgot Password
|--------------------------------------------------------------------------
*/
Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
    ->middleware('guest')
    ->name('password.request');

Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
    ->middleware('guest')
    ->name('password.email');

/*
|--------------------------------------------------------------------------
| Note: Seller Registration is now combined with user registration
| SRS-MartPlace-01: Register creates both User + Seller in one step
|--------------------------------------------------------------------------
*/
/*
|--------------------------------------------------------------------------
| Admin Area
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'can:verify-sellers'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // 🔹 Dashboard admin
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');

        // 🔹 (opsional) kalau mau index seller tetap di bawah /admin/toko
        Route::prefix('toko')->name('sellers.')->group(function () {
            Route::get('/registrasi', [SellerVerificationController::class, 'index'])
                ->name('index');
            Route::get('/registrasi/{seller}', [SellerVerificationController::class, 'show'])
                ->name('show');
            Route::post('/{seller}/approve', [SellerVerificationController::class, 'approve'])
                ->name('approve');
            Route::post('/{seller}/reject', [SellerVerificationController::class, 'reject'])
                ->name('reject');
        });

        // 🔹 Laporan Admin (SRS-09, 10, 11) - Platform Level Reports
        Route::prefix('laporan')->name('reports.')->group(function () {
            Route::get('/sellers', [ReportController::class, 'sellers'])
                ->name('sellers'); // SRS-09
            Route::get('/sellers/export', [ReportController::class, 'exportSellers'])
                ->name('sellers.export'); // SRS-09 Export
            
            Route::get('/sellers-by-location', [ReportController::class, 'sellersByLocation'])
                ->name('sellers-location'); // SRS-10
            Route::get('/sellers-by-location/export', [ReportController::class, 'exportSellersByLocation'])
                ->name('sellers-location.export'); // SRS-10 Export
            
            Route::get('/product-ranking', [ReportController::class, 'productRanking'])
                ->name('product-ranking'); // SRS-11
            Route::get('/product-ranking/export', [ReportController::class, 'exportProductRanking'])
                ->name('product-ranking.export'); // SRS-11 Export
        });
    });

Route::middleware('auth')->get('/market/dashboard', [\App\Http\Controllers\Seller\DashboardController::class, 'index'])
    ->name('seller.dashboard');

/*
|--------------------------------------------------------------------------
| Seller Registration
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/seller/register', [SellerRegistrationController::class, 'create'])
        ->name('seller.register');
    Route::post('/seller/register', [SellerRegistrationController::class, 'store'])
        ->name('seller.register.store');
});

/*
|--------------------------------------------------------------------------
| Seller Product Management (SRS-MartPlace-03)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->prefix('seller')->name('seller.')->group(function () {
    Route::resource('products', \App\Http\Controllers\Seller\ProductManagementController::class)
        ->except(['show']);
    
    // 🔹 Seller Reports (SRS-MartPlace-12, 13, 14)
    Route::prefix('laporan')->name('reports.')->group(function () {
        Route::get('/stock', [\App\Http\Controllers\Seller\ReportController::class, 'stock'])
            ->name('stock'); // SRS-12
        Route::get('/stock/export', [\App\Http\Controllers\Seller\ReportController::class, 'exportStock'])
            ->name('stock.export'); // SRS-12 Export
        
        Route::get('/rating', [\App\Http\Controllers\Seller\ReportController::class, 'rating'])
            ->name('rating'); // SRS-13
        Route::get('/rating/export', [\App\Http\Controllers\Seller\ReportController::class, 'exportRating'])
            ->name('rating.export'); // SRS-13 Export
        
        Route::get('/restock', [\App\Http\Controllers\Seller\ReportController::class, 'restock'])
            ->name('restock'); // SRS-14
        Route::get('/restock/export', [\App\Http\Controllers\Seller\ReportController::class, 'exportRestock'])
            ->name('restock.export'); // SRS-14 Export
    });
});


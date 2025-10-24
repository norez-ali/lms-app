<?php

use App\Http\Controllers\Student\CartController;
use App\Http\Controllers\Student\CheckoutController;
use App\Http\Controllers\Student\PaymentController;
use App\Http\Controllers\Student\StudentDashboardController;
use App\Models\Student\Payment;
use Illuminate\Support\Facades\Route;

// Student routes
Route::middleware(['auth', 'role:student'])->prefix('student')->group(function () {
    Route::get('/dashboard', [StudentDashboardController::class, 'index'])->name('student.dashboard');
    //managing cart items
    Route::post('/add/cart/{courseId}', [CartController::class, 'addToCart'])->name('student.add.cart');
    Route::get('/cart/view', [CartController::class, 'viweCart'])->name('student.view.cart');
    Route::delete('/remove/cart/{id}', [CartController::class, 'removeFromCart'])
        ->name('student.cart.remove');
    //managing checkouts
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('student.view.checkout');
    Route::post('/create-payment', [PaymentController::class, 'createPayment'])->name('create.payment');
    Route::get('checkout/buy/{courseId}', [PaymentController::class, 'buyNow'])->name('student.buy.checkout');
    Route::post('/buy-now/{courseId}', [PaymentController::class, 'buyNowCheck'])->name('buy.now');
});

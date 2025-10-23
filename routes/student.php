<?php

use App\Http\Controllers\Student\CartController;
use App\Http\Controllers\Student\CheckoutController;
use App\Http\Controllers\Student\PaymentController;
use Illuminate\Support\Facades\Route;

// Student routes
Route::middleware(['auth', 'role:student'])->prefix('student')->group(function () {
    Route::get('/dashboard', fn() => view('dashboard.student.index'))->name('student.dashboard');
    //managing cart items
    route::post('/add/cart/{courseId}', [CartController::class, 'addToCart'])->name('student.add.cart');
    route::get('/cart/view', [CartController::class, 'viweCart'])->name('student.view.cart');
    Route::delete('/remove/cart/{id}', [CartController::class, 'removeFromCart'])
        ->name('student.cart.remove');
    //managing checkouts
    route::get('/checkout', [CheckoutController::class, 'index'])->name('student.view.checkout');
    Route::post('/create-payment', [PaymentController::class, 'createPayment'])->name('create.payment');
    Route::post('/store-payment', [PaymentController::class, 'storePayment'])->name('store.payment');
});

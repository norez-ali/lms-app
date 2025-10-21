<?php

use App\Http\Controllers\Student\CartController;
use Illuminate\Support\Facades\Route;

// Student routes
Route::middleware(['auth', 'role:student'])->prefix('student')->group(function () {
    Route::get('/dashboard', fn() => view('dashboard.student.index'))->name('student.dashboard');
    //adding cart items
    route::post('/add/cart/{courseId}', [CartController::class, 'addToCart'])->name('student.add.cart');
});

<?php

use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\Route;

// Admin routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', fn() => view('dashboard.admin.index'))->name('admin.dashboard');
    Route::get('/categories', [CategoryController::class, 'index'])->name('admin.categories');
    Route::get('/add/category', [CategoryController::class, 'add'])->name('admin.add.category');
    Route::post('/add/category', [CategoryController::class, 'store'])->name('admin.store.category');
    Route::get('/edit/category/{categoryId}', [CategoryController::class, 'editCategory'])->name('admin.edit.category');
});

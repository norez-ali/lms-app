<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CourseController;
use Illuminate\Support\Facades\Route;

// Admin routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', fn() => view('dashboard.admin.index'))->name('admin.dashboard');
    Route::get('/categories', [CategoryController::class, 'index'])->name('admin.categories');
    Route::get('/add/category', [CategoryController::class, 'add'])->name('admin.add.category');
    Route::post('/add/category', [CategoryController::class, 'store'])->name('admin.store.category');
    Route::get('/edit/category/{categoryId}', [CategoryController::class, 'editCategory'])->name('admin.edit.category');
    Route::put('/update/category/{categoryId}', [CategoryController::class, 'updateCategory'])->name('admin.update.category');
    Route::delete('/delete/category/{categoryId}', [CategoryController::class, 'deleteCategory'])->name('admin.delete.category');

    //following routes for the courses management by the admin
    Route::get('/courses', [CourseController::class, 'index'])->name('admin.courses');
    Route::get('/create/courses', [CourseController::class, 'create'])->name('admin.create.course');
    Route::post('/create/courses', [CourseController::class, 'store'])->name('admin.store.course');
    Route::get('/edit/course/{courseId}', [CourseController::class, 'edit'])->name('admin.edit.course');
    Route::put('/update/courses/{courseId}', [CourseController::class, 'update'])->name('admin.update.course');
    Route::delete('/delete/courses/{courseId}', [CourseController::class, 'destroy'])->name('admin.delete.course');
});

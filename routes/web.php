<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
// Route::get('/test', function () {
//     return view('dashboard.admin.index');
// });
// Admin routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', fn() => view('dashboard.admin.index'))->name('admin.dashboard');
});

// Teacher routes
Route::middleware(['auth', 'role:teacher'])->prefix('teacher')->group(function () {
    Route::get('/dashboard', fn() => view('dashboard.teacher.index'))->name('teacher.dashboard');
});

// Student routes
Route::middleware(['auth', 'role:student'])->prefix('student')->group(function () {
    Route::get('/dashboard', fn() => view('dashboard.student.index'))->name('student.dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

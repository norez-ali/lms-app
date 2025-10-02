<?php


use Illuminate\Support\Facades\Route;

// Student routes
Route::middleware(['auth', 'role:student'])->prefix('student')->group(function () {
    Route::get('/dashboard', fn() => view('dashboard.student.index'))->name('student.dashboard');
});

<?php


use Illuminate\Support\Facades\Route;

// Teacher routes
Route::middleware(['auth', 'role:teacher'])->prefix('teacher')->group(function () {
    Route::get('/dashboard', fn() => view('dashboard.teacher.index'))->name('teacher.dashboard');
});

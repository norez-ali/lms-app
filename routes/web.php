<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/profile/update', [ProfileController::class, 'store'])->name('profile.update');
    Route::post('/profile/photo/update', [ProfileController::class, 'uploadPhoto'])->name('profile.photo.update');
    Route::delete('/profile/photo/delete', [ProfileController::class, 'deletePhoto'])->name('profile.photo.delete');
    Route::put('/profile/password/update', [ProfileController::class, 'updatePassword'])
        ->name('profile.password.update');
    Route::post('/profile/experience', [ProfileController::class, 'updateExperience'])
        ->name('profile.experience.update');
    Route::post('/profile/education', [ProfileController::class, 'updateEducation'])
        ->name('profile.education.update');
});

require __DIR__ . '/auth.php';
require __DIR__ . '/student.php';
require __DIR__ . '/teacher.php';
require __DIR__ . '/admin.php';

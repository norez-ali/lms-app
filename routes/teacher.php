<?php

use App\Http\Controllers\Teacher\CourseApplicationController;
use Illuminate\Support\Facades\Route;

// Teacher routes
Route::middleware(['auth', 'role:teacher'])->prefix('teacher')->group(function () {
    Route::get('/dashboard', fn() => view('dashboard.teacher.index'))->name('teacher.dashboard');
    //routes for submiiting applications for courses to the admin
    Route::get('/category/view', [CourseApplicationController::class, 'index'])->name('teacher.category.view');
    Route::get('/courses/view/{categoryId}', [CourseApplicationController::class, 'viewCourses'])->name('teacher.view.courses');
    Route::post('/course/apply/{courseId}', [CourseApplicationController::class, 'store'])->name('teacher.apply.course');
    Route::delete('/course/delete/{courseId}', [CourseApplicationController::class, 'destroy'])->name('teacher.withdraw.course');
    Route::get('/view/applications', [CourseApplicationController::class, 'viewApplications'])->name('teacher.view.applications');
});

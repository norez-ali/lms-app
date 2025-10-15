<?php

use App\Http\Controllers\Teacher\CourseApplicationController;
use App\Http\Controllers\Teacher\ManageCourseController;
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

    //Routes for managing the courses assigned to the teacher
    Route::get('/manage/courses', [ManageCourseController::class, 'index'])->name('teacher.manage.courses');
    Route::get('/edit/course/{id}', [ManageCourseController::class, 'edit'])->name('teacher.edit.course');
    //adding section to the course
    Route::post('/add/section/{id}', [ManageCourseController::class, 'addSection'])->name('teacher.add.section');
    Route::delete('/delete/section/{sectionId}', [ManageCourseController::class, 'deleteSection'])->name('teacher.delete.section');
    //adding lesson to the course
    Route::post('/add/lesson/{courseId}', [ManageCourseController::class, 'addLesson'])->name('teacher.add.lesson');
    Route::delete('/delete/lesson/{lessonId}', [ManageCourseController::class, 'deleteLesson'])->name('teacher.lesson.delete');
    Route::get('/view/lesson/{lessonId}', [ManageCourseController::class, 'viewLesson'])->name('teacher.view.lesson');
    //routes for adding quizzes
    Route::post('/add/quiz/{courseId}', [ManageCourseController::class, 'addQuiz'])->name('teacher.add.quiz');
});

<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use App\Models\Admin\Course;
use App\Models\CourseTeacherRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseApplicationController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('dashboard.teacher.course_application.view_categories', get_defined_vars());
    }
    public function viewCourses($categoryId)
    {
        // Fetch the category with its name
        $category = Category::findOrFail($categoryId);

        // Fetch all courses that belong to this category
        $courses = Course::where('category_id', $categoryId)->get();
        return view('dashboard.teacher.course_application.view_courses', get_defined_vars());
    }
    public function store(Request $request, $courseId)
    {
        $teacherId = Auth::id();

        // Prevent duplicate request
        $existing = CourseTeacherRequest::where('course_id', $courseId)
            ->where('teacher_id', $teacherId)
            ->first();

        if ($existing) {
            return response()->json(['success' => false, 'message' => 'You have already sent a request for this course.']);
        }

        CourseTeacherRequest::create([
            'course_id' => $courseId,
            'teacher_id' => $teacherId,
        ]);

        return response()->json(['success' => true, 'message' => 'Your request has been sent successfully.']);
    }
}

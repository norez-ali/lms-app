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
        $category = Category::findOrFail($categoryId);

        // Get the teacher's ID
        $teacherId = auth()->id();

        // Get all applications for this teacher
        $applications = CourseTeacherRequest::where('teacher_id', $teacherId)->get();

        // Get IDs of pending courses (we want to exclude these)
        $pendingCourseIds = $applications
            ->where('status', 'pending')
            ->pluck('course_id')
            ->toArray();

        // Get IDs of rejected courses (we will include these)
        $rejectedCourseIds = $applications
            ->where('status', 'rejected')
            ->pluck('course_id')
            ->toArray();

        // Fetch courses in this category
        $courses = Course::where('category_id', $categoryId)
            ->where(function ($query) use ($pendingCourseIds, $rejectedCourseIds) {
                $query->whereNotIn('id', $pendingCourseIds)
                    ->orWhereIn('id', $rejectedCourseIds);
            })
            ->with('category')
            ->get();
        return view('dashboard.teacher.course_application.view_courses', get_defined_vars());
    }

    public function store(Request $request, $courseId)
    {
        $teacherId = Auth::id();

        // Check if a request already exists for this course
        $existing = CourseTeacherRequest::where('course_id', $courseId)
            ->where('teacher_id', $teacherId)
            ->first();

        if ($existing) {
            if ($existing->status === 'pending') {
                // Already pending — don’t allow duplicate request
                return response()->json([
                    'success' => false,
                    'message' => 'You have already sent a request for this course.'
                ]);
            } elseif ($existing->status === 'rejected') {
                // Reapply: change status back to pending
                $existing->update(['status' => 'pending']);

                return response()->json([
                    'success' => true,
                    'message' => 'Your request has been resubmitted for approval.'
                ]);
            }
        }

        // No existing request — create a new one
        CourseTeacherRequest::create([
            'course_id' => $courseId,
            'teacher_id' => $teacherId,
            'status' => 'pending',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Your request has been sent successfully.'
        ]);
    }
    public function viewApplications()
    {
        // Get logged-in teacher
        $teacherId = Auth::id();

        // Fetch only pending course requests by this teacher
        $applications = CourseTeacherRequest::with('course.category')
            ->where('teacher_id', $teacherId)
            ->where('status', 'pending')
            ->orWhere('status', 'rejected')
            ->latest()
            ->get();

        // Return to view with data
        return view('dashboard.teacher.course_application.view_applications', compact('applications'));
    }
    public function destroy($courseId)
    {
        $teacherId = auth()->id();

        $request = CourseTeacherRequest::where('course_id', $courseId)
            ->where('teacher_id', $teacherId)
            ->where('status', 'pending')

            ->first();

        if (!$request) {
            return response()->json(['success' => false, 'message' => 'No pending request found.']);
        }

        $request->delete();

        return response()->json(['success' => true, 'message' => 'Course withdrawal successful.']);
    }
}

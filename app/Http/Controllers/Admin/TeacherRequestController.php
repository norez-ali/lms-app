<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Course;
use App\Models\CourseTeacherRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeacherRequestController extends Controller
{
    public function index()
    {
        // Fetch all requests that are still pending
        $requests = CourseTeacherRequest::with(['teacher', 'course.category'])
            ->where('status', 'pending')
            ->latest()
            ->get();

        // Return view with requests data
        return view('dashboard.admin.requests.index', compact('requests'));
    }
    public function approve($requestId)
    {
        $request = CourseTeacherRequest::find($requestId);

        if (!$request) {
            return response()->json([
                'success' => false,
                'message' => 'Application not found for ID: ' . $requestId
            ]);
        }

        $course = $request->course;
        $course->update(['teacher_id' => $request->teacher_id]);

        $request->update(['status' => 'approved']);

        return response()->json([
            'success' => true,
            'message' => 'Application approved successfully!'
        ]);
    }
    public function reject($requestId)
    {
        // Find the request
        $application = CourseTeacherRequest::find($requestId);

        if (!$application) {
            return response()->json([
                'success' => false,
                'message' => 'Application not found.'
            ]);
        }

        // Update status to rejected
        $application->update([
            'status' => 'rejected'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'The application has been rejected successfully.'
        ]);
    }
}

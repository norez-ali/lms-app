<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Student\Enrollment;
use Illuminate\Http\Request;

class StudentDashboardController extends Controller
{
    public function index()
    {
        $enrollments = Enrollment::where('user_id', auth()->id())
            ->with('course')
            ->paginate(15);

        return view('dashboard.student.index', get_defined_vars());
    }
}

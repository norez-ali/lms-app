<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Course;
use App\Models\Student\Payment;
use App\Models\User;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalPayments = Payment::sum('amount');
        $totalCourses = Course::with([
            'sections.lessons',
            'teacher.profile'
        ])->get();
        $students = User::where('role', 'student')->count();
        $teachers = User::where('role', 'teacher')->with('profile')->get();
        return view('dashboard.admin.index',  get_defined_vars());
    }
}

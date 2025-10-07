<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $students = User::where('role', 'student')->get();
        $teachers = User::where('role', 'teacher')->get();
        return view('admin.users.index', compact('students', 'teachers'));
    }
}

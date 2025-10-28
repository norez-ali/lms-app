<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $students = User::where('role', 'student')->with('profile')->get();
        $teachers = User::where('role', 'teacher')->with('profile')->get();
        return view('dashboard.admin.users.index', compact('students', 'teachers'));
    }
    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);

            // Prevent deleting Admin itself if you want
            if ($user->role === 'admin') {
                return response()->json(['error' => 'Admins cannot be deleted.'], 403);
            }

            $user->delete();

            return response()->json([
                'success' => true,
                'message' => 'User deleted successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting user: ' . $e->getMessage()
            ], 500);
        }
    }
}

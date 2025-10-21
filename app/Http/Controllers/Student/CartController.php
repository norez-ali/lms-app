<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Admin\Course;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart($courseId)
    {
        // ✅ 1. Check if user is logged in
        if (!auth()->check()) {
            return response()->json(['redirect_to_login' => true]);
        }

        $user = auth()->user();

        // ✅ 2. Allow only users with 'student' role
        if ($user->role !== 'student') {
            return response()->json([
                'success' => false,
                'message' => 'Only students can add courses to the cart.'
            ]);
        }

        // ✅ 3. Check if course exists
        $course = Course::find($courseId);
        if (!$course) {
            return response()->json([
                'success' => false,
                'message' => 'Course not found.'
            ]);
        }

        // ✅ 4. Check if already in cart
        $exists = $user->cart()->where('course_id', $courseId)->exists();

        if ($exists) {
            return response()->json([
                'success' => false,
                'message' => 'Course is already in your cart.'
            ]);
        }

        // ✅ 5. Add to cart
        $user->cart()->create([
            'course_id' => $courseId
        ]);

        // ✅ 6. Return success message
        return response()->json([
            'success' => true,
            'message' => 'Course added to your cart successfully!'
        ]);
    }
}

<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Admin\Course;
use App\Models\Student\Cart;
use App\Models\Student\Enrollment;
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


        $enrolledCourse = Enrollment::where('user_id', $user->id)
            ->where('course_id', $courseId)
            ->first();

        if ($enrolledCourse) {
            return response()->json([
                'success' => false,
                'message' => 'Already enrolled in this course'
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
    public function viweCart()
    {
        $cartItems = Cart::where('user_id', auth()->id())
            ->with('course') // eager load course details
            ->get();
        $total = $cartItems->sum(function ($item) {
            return $item->course->price ?? 0;
        });


        return view('dashboard.student.cart.index', compact('cartItems', 'total'));
    }
    public function removeFromCart($id)
    {
        $cartItem = Cart::where('id', $id)
            ->where('user_id', auth()->id())
            ->first();

        if (!$cartItem) {
            return response()->json(['success' => false, 'message' => 'Cart item not found.']);
        }

        $cartItem->delete();

        return response()->json([
            'success' => true,
            'message' => 'Course removed from cart successfully!',
        ]);
    }
}

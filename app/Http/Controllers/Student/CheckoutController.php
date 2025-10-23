<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Student\Cart;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        $cartItems = Cart::where('user_id', auth()->id())
            ->with('course') // eager load course details
            ->get();
        $total = $cartItems->sum(function ($item) {
            return $item->course->price ?? 0;
        });
        return view('dashboard.student.checkout.index', get_defined_vars());
    }
}

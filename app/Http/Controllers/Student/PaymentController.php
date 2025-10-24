<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Admin\Course;
use App\Models\Student\Cart;
use App\Models\Student\CourseUser;
use App\Models\Student\Enrollment;
use App\Models\Student\Payment;
use App\Models\Student\PaymentIntent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Stripe\Stripe;
use Stripe\StripeClient;

class PaymentController extends Controller
{
    public function createPayment(Request $request)
    {
        $user = auth()->user();

        // 1️⃣ Get cart and calculate total
        $cartItems = Cart::where('user_id', $user->id)
            ->with('course')
            ->get();

        if ($cartItems->isEmpty()) {
            return back()->with('error', 'Your cart is empty.');
        }

        // 🔍 Filter out courses the user is already enrolled in
        $alreadyEnrolledCourseIds = Enrollment::where('user_id', $user->id)
            ->pluck('course_id')
            ->toArray();

        $cartItems = $cartItems->reject(function ($item) use ($alreadyEnrolledCourseIds) {
            return in_array($item->course_id, $alreadyEnrolledCourseIds);
        });

        if ($cartItems->isEmpty()) {
            return back()->with('error', 'You are already enrolled in all the selected courses.');
        }

        // 💰 Calculate total only for new (non-enrolled) courses
        $total = $cartItems->sum(fn($item) => $item->course->price ?? 0);
        $amountInCents = intval($total * 100);

        DB::beginTransaction();

        try {
            // 2️⃣ Create Stripe charge
            $stripe = new StripeClient(env('STRIPE_SECRET_KEY'));
            $charge = $stripe->charges->create([
                'amount' => $amountInCents,
                'currency' => 'usd',
                'source' => $request->stripeToken,
                'description' => 'Course Purchase for user ' . $user->id,
            ]);

            // 3️⃣ Record payment
            $payment = Payment::create([
                'user_id' => $user->id,
                'stripe_charge_id' => $charge->id,
                'amount' => $total,
                'currency' => $charge->currency,
                'status' => $charge->status,
                'metadata' => json_encode($charge->metadata ?? []),
            ]);

            // 4️⃣ Enroll only for new courses
            foreach ($cartItems as $item) {
                Enrollment::create([
                    'user_id' => $user->id,
                    'course_id' => $item->course_id,

                ]);
            }

            // 5️⃣ Remove only purchased courses from cart
            Cart::where('user_id', $user->id)
                ->whereIn('course_id', $cartItems->pluck('course_id'))
                ->delete();

            DB::commit();

            return redirect()->route('student.dashboard')
                ->with('success', 'Payment successful! You are now enrolled in your new courses.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Payment error: ' . $e->getMessage());
            return back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }
    public function buyNow(Request $request, $courseId)
    {
        $course = Course::find($courseId);
        return view('dashboard.student.checkout.buy_now', get_defined_vars());
    }
    public function buyNowCheck(Request $request, $courseId)
    {
        $user = auth()->user();
        $course = Course::findOrFail($courseId);

        if (Enrollment::where('user_id', $user->id)->where('course_id', $courseId)->exists()) {
            return back()->with('error', 'You are already enrolled in this course.');
        }

        $stripe = new StripeClient(env('STRIPE_SECRET_KEY'));
        $charge = $stripe->charges->create([
            'amount' => $course->price * 100,
            'currency' => 'usd',
            'source' => $request->stripeToken,
            'description' => "Buy Now - Course: {$course->title} by user {$user->id}",
        ]);

        Payment::create([
            'user_id' => $user->id,
            'stripe_charge_id' => $charge->id,
            'amount' => $course->price,
            'currency' => $charge->currency,
            'status' => $charge->status,
            'metadata' => json_encode($charge->metadata ?? []),
        ]);

        Enrollment::create([
            'user_id' => $user->id,
            'course_id' => $courseId,
        ]);

        return redirect()->route('student.dashboard')->with('success', 'Payment successful!');
    }
}

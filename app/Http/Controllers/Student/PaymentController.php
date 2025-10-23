<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
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
        $cartItems = Cart::where('user_id', $user->id)->with('course')->get();

        if ($cartItems->isEmpty()) {
            return back()->with('error', 'Your cart is empty.');
        }

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
            // dd($charge);
            // ✅ After successful charge, continue:
            Payment::create([
                'user_id' => $user->id,
                'stripe_charge_id' => $charge->id,
                'amount' => $total,
                'currency' => $charge->currency,
                'status' => $charge->status,
                'metadata' => json_encode($charge->metadata ?? []),
            ]);

            foreach ($cartItems as $item) {
                Enrollment::create([
                    'user_id' => $user->id,
                    'course_id' => $item->course_id,
                ]);
            }

            Cart::where('user_id', $user->id)->delete();

            DB::commit();

            return redirect()->route('student.dashboard')
                ->with('success', 'Payment successful! You are now enrolled.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Payment error: ' . $e->getMessage());
            return back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }
}

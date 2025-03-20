<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Illuminate\Support\Facades\Session;
use App\Models\Order;

class RazorpayPaymentController extends Controller
{
    protected $razorpayKey;
    protected $razorpaySecret;

    public function __construct()
    {
        // Load Razorpay API keys from .env
        $this->razorpayKey = env('RAZORPAY_KEY_ID');
        $this->razorpaySecret = env('RAZORPAY_KEY_SECRET');
    }

    /**
     * Handle payment after Razorpay form submission
     */
    public function store(Request $request)
    {
        // Initialize Razorpay API
        $api = new Api($this->razorpayKey, $this->razorpaySecret);

        // Retrieve payment details from Razorpay response
        $paymentId = $request->input('razorpay_payment_id');
        $razorpayOrderId = Session::get('razorpay_order_id');
        $finalAmount = Session::get('final_amount');
        $orderId = Session::get('order_id');

        if (!$paymentId || !$razorpayOrderId || !$orderId) {
            return redirect()->route('cart.list')->with('error', 'Invalid payment details. Please try again.');
        }

        try {
            // Fetch payment details
            $payment = $api->payment->fetch($paymentId);

            // Verify payment
            if ($payment->status === 'captured') {
                // Update order status in the database
                $order = Order::find($orderId);
                if ($order) {
                    $order->payment_status = 'paid';
                    $order->payment_id = $paymentId;
                    $order->save();
                }

                // Clear session and cart
                Session::forget(['razorpay_order_id', 'final_amount', 'order_id']);
                \Cart::clear();

                return redirect()->route('order.success')->with('success', 'Payment successful!');
            } else {
                return redirect()->route('cart.list')->with('error', 'Payment verification failed. Please try again.');
            }
        } catch (\Exception $e) {
            return redirect()->route('cart.list')->with('error', 'Payment failed: ' . $e->getMessage());
        }
    }
}

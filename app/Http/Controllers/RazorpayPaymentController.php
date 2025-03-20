<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use App\Models\Order;

class RazorpayPaymentController extends Controller
{
    protected $razorpayKey;
    protected $razorpaySecret;

    public function __construct()
    {
        // Load Razorpay API keys from config or .env
        $this->razorpayKey = env('RAZORPAY_KEY_ID');
        $this->razorpaySecret = env('RAZORPAY_KEY_SECRET');
    }

    public function pay(Request $request)
    {
        // Retrieve the final amount from session (set in PaymentController)
        $finalAmount = Session::get('final_amount');
        $orderId = Session::get('order_id');

        if (!$finalAmount || !$orderId) {
            return redirect()->back()->with('error', 'Invalid payment request. Please try again.');
        }

        // Convert amount to the smallest currency unit (paise for INR)
        $amount = $finalAmount * 100;

        try {
            // Initialize Razorpay API
            $api = new Api($this->razorpayKey, $this->razorpaySecret);

            // Create a Razorpay order with the **discounted** total amount
            $razorpayOrder = $api->order->create([
                'receipt'  => 'ORDER_' . $orderId,
                'amount'   => $amount,
                'currency' => 'INR',
                'payment_capture' => 1, // Auto capture payment
            ]);

            // Store the Razorpay order ID for verification after payment
            Session::put('razorpay_order_id', $razorpayOrder['id']);

            // Update the order record in the database with Razorpay Order ID
            $order = Order::find($orderId);
            if ($order) {
                $order->razorpay_order_id = $razorpayOrder['id'];
                $order->save();
            }

            // Load a view to proceed with Razorpay payment (passing the necessary details)
            return view('checkout.razorpay_payment', [
                'razorpayOrderId' => $razorpayOrder['id'],
                'razorpayKey'     => $this->razorpayKey,
                'finalAmount'     => $finalAmount,
                'orderId'         => $orderId,
            ]);

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to initiate payment: ' . $e->getMessage());
        }
    }
}

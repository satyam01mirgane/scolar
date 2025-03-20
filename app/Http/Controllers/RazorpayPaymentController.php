<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Illuminate\Support\Str;
use App\Models\Order;

class RazorpayPaymentController extends Controller
{
    protected $razorpayKey;
    protected $razorpaySecret;

    public function __construct()
    {
        // Load Razorpay API keys from config or env
        $this->razorpayKey = config('services.razorpay.key');
        $this->razorpaySecret = config('services.razorpay.secret');
    }

    public function pay(Request $request)
    {
        // Retrieve the final amount after discounts (calculated earlier)
        $finalAmount = session('final_amount');
        $orderId    = session('order_id');

        if (!$finalAmount) {
            return redirect()->back()->with('error', 'Payment amount not found.');
        }

        // Convert amount to smallest currency unit (e.g., paise for INR)
        $amount = $finalAmount * 100;

        try {
            // Initialize Razorpay API
            $api = new Api($this->razorpayKey, $this->razorpaySecret);
            // Create a Razorpay order with the **discounted** total amount
            $razorpayOrder = $api->order->create([
                'receipt'  => $orderId ?: Str::random(10),
                'amount'   => $amount,
                'currency' => 'INR',
            ]);

            // Store the Razorpay order ID for verification after payment
            session(['razorpay_order_id' => $razorpayOrder['id']]);

            // Load a view to proceed with Razorpay payment (passing the necessary details)
            return view('checkout.razorpay_payment', [
                'razorpayOrderId' => $razorpayOrder['id'],
                'razorpayKey'     => $this->razorpayKey,
                'finalAmount'     => $finalAmount,
                'orderId'         => $orderId,
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to initiate payment: '.$e->getMessage());
        }
    }
}

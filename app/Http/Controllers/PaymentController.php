<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Razorpay\Api\Api;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Cart;

class PaymentController extends Controller
{
    private $razorpay;

    public function __construct()
    {
        $this->razorpay = new Api(
            env('RAZORPAY_KEY_ID'),
            env('RAZORPAY_KEY_SECRET')
        );
    }

    public function processOrder(Request $request)
    {
        // Validate request
        $validator = Validator::make($request->all(), [
            'coupon_code' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        // Fetch cart items
        $cartItems = Cart::getContent();
        $subtotal = Cart::getTotal();
        $itemDiscounts = 0;

        // Calculate total item discounts
        foreach ($cartItems as $item) {
            $itemDiscounts += $this->calculateItemDiscount($item->id);
        }

        // Apply coupon discount
        $coupon = $this->validateCoupon($request->coupon_code);
        $couponDiscount = $coupon ? $this->calculateCouponDiscount($subtotal, $coupon) : 0;

        // Final price after discounts
        $grandTotal = ($subtotal - $itemDiscounts - $couponDiscount);

        // Handle free orders
        if ($grandTotal <= 0) {
            return $this->handleFreeOrder();
        }

        // Create Razorpay order using the discounted price
        try {
            $order = $this->createRazorpayOrder($grandTotal);

            // Store payment data in session
            Session::put('razorpay_order', [
                'id' => $order->id,
                'amount' => $grandTotal,  // Discounted amount
                'coupon_code' => $request->coupon_code,
                'coupon_discount' => $couponDiscount,
                'item_discount' => $itemDiscounts
            ]);

            return view('payment.razorpay-checkout', [
                'order_id' => $order->id,
                'amount' => $grandTotal * 100, // Razorpay expects amount in paise
                'currency' => 'INR',
                'user' => Auth::user()
            ]);

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Payment initialization failed: ' . $e->getMessage());
        }
    }

    public function handleCallback(Request $request)
    {
        $paymentId = $request->input('razorpay_payment_id');
        $orderId = $request->input('razorpay_order_id');
        $signature = $request->input('razorpay_signature');

        // Verify payment signature
        try {
            $attributes = [
                'razorpay_order_id' => $orderId,
                'razorpay_payment_id' => $paymentId,
                'razorpay_signature' => $signature
            ];

            $this->razorpay->utility->verifyPaymentSignature($attributes);

            // Store payment details
            $payment = $this->razorpay->payment->fetch($paymentId);
            $orderData = Session::get('razorpay_order');

            DB::table('payments')->insert([
                'user_id' => Auth::id(),
                'order_id' => $orderId,
                'payment_id' => $paymentId,
                'amount' => $orderData['amount'],
                'currency' => 'INR',
                'coupon_code' => $orderData['coupon_code'],
                'item_discount' => $orderData['item_discount'],
                'coupon_discount' => $orderData['coupon_discount'],
                'payment_method' => $payment->method,
                'status' => $payment->status,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            // Clear cart and session data
            Cart::clear();
            Session::forget('razorpay_order');

            return redirect()->route('order.success')
                ->with('success', 'Payment completed successfully!');

        } catch (\Exception $e) {
            return redirect()->route('payment.failed')
                ->with('error', 'Payment verification failed: ' . $e->getMessage());
        }
    }

    private function createRazorpayOrder($amount)
    {
        return $this->razorpay->order->create([
            'receipt' => 'ORDER_' . uniqid(),
            'amount' => $amount * 100, // Convert to paise
            'currency' => 'INR',
            'payment_capture' => 1
        ]);
    }

    private function validateCoupon($code)
    {
        // Implement your coupon validation logic
        if ($code === 'FLAT10') {
            return ['code' => $code, 'type' => 'percentage', 'value' => 10];
        }
        return null;
    }

    private function calculateItemDiscount($itemId)
    {
        // Implement your item-specific discount logic
        return 0; // Example value
    }

    private function calculateCouponDiscount($subtotal, $coupon)
    {
        if ($coupon['type'] === 'percentage') {
            return ($subtotal * $coupon['value']) / 100;
        }
        return $coupon['value'];
    }

    private function handleFreeOrder()
    {
        try {
            DB::table('payments')->insert([
                'user_id' => Auth::id(),
                'amount' => 0,
                'currency' => 'INR',
                'status' => 'free',
                'created_at' => now(),
                'updated_at' => now()
            ]);

            Cart::clear();
            
            return redirect()->route('order.success')
                ->with('success', 'Free order processed successfully!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Free order processing failed: ' . $e->getMessage());
        }
    }
}

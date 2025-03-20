<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Session;
use Exception;
use Auth;
use DB;
use App\Order;
use Mail;
  
class RazorpayPaymentController extends Controller
{
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

        // Calculate Final Total After Discounts
        $discountedTotal = ($subtotal - $itemDiscounts - $couponDiscount);

        // Ensure the amount sent to Razorpay is correct
        if ($discountedTotal < 0) {
            $discountedTotal = 0;
        }

        // Handle Free Orders
        if ($discountedTotal == 0) {
            return $this->handleFreeOrder();
        }

        // Create Razorpay Order with Correct Discounted Amount
        try {
            $api = new Api('rzp_live_lP2LYJNlqAhhTs', 'jjn6moAvZe1tYKZ5ZgVN6GIM');
            $order = $api->order->create([
                'receipt' => 'ORDER_' . uniqid(),
                'amount' => $discountedTotal * 100, // Convert to paise
                'currency' => 'INR',
                'payment_capture' => 1
            ]);

            // Store payment data in session
            Session::put('razorpay_order', [
                'id' => $order->id,
                'amount' => $discountedTotal,  // Discounted amount
                'coupon_code' => $request->coupon_code,
                'coupon_discount' => $couponDiscount,
                'item_discount' => $itemDiscounts
            ]);

            return view('payment.razorpay-checkout', [
                'order_id' => $order->id,
                'amount' => $discountedTotal * 100, // Razorpay expects amount in paise
                'currency' => 'INR',
                'user' => Auth::user()
            ]);

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Payment initialization failed: ' . $e->getMessage());
        }
    }

    public function handleCallback(Request $request)
    {
        $input = $request->all();
        $api = new Api('rzp_live_lP2LYJNlqAhhTs', 'jjn6moAvZe1tYKZ5ZgVN6GIM');

        try {
            $payment = $api->payment->fetch($input['razorpay_payment_id']);

            if (!empty($input['razorpay_payment_id']) && $payment->status === 'authorized') {
                // Capture the payment
                $response = $payment->capture(['amount' => $payment['amount']]);

                if ($response->status == 'captured') {
                    $status = 'Completed';
                } else {
                    $status = 'Failed';
                }

                // Fetch order ID from DB instead of session
                $order_id = DB::table('app_payment_info')
                    ->where('payment_id', $input['razorpay_payment_id'])
                    ->value('order_id');

                $payinfo = [
                    'payment_status' => $status,
                    'token' => $input['_token'],
                    'payment_id' => $input['razorpay_payment_id'],
                    'payment_update_date' => now(),
                    'payment_date' => now()
                ];

                // Update payment record
                DB::table('app_payment_info')
                    ->where('order_id', $order_id)
                    ->where('user_id', Auth::user()->id)
                    ->update($payinfo);

                // Send confirmation emails
                $this->sendOrderMail($order_id);
                $this->sendSuccessPurchase($order_id);

                // Clear session & cart only after successful update
                $request->session()->forget('order_id');
                \Cart::clear();

                session()->flash('success', 'Order Placed Successfully!');
                return redirect()->route('dashboard');
            } else {
                return redirect()->route('cart.list')->with('error', 'Payment not authorized.');
            }
        } catch (Exception $e) {
            return redirect()->route('cart.list')->with('error', 'Payment processing failed: ' . $e->getMessage());
        }
    }

    private function calculateItemDiscount($itemId)
    {
        // Fetch the item discount from database or logic
        $discount = DB::table('discounts')->where('item_id', $itemId)->value('discount_amount');
        return $discount ?? 0; // If no discount, return 0
    }

    private function validateCoupon($code)
    {
        // Implement your coupon validation logic
        if ($code === 'FLAT10') {
            return ['code' => $code, 'type' => 'percentage', 'value' => 10]; // 10% discount
        }
        return null;
    }

    private function calculateCouponDiscount($subtotal, $coupon)
    {
        if ($coupon['type'] === 'percentage') {
            return ($subtotal * $coupon['value']) / 100;
        }
        return $coupon['value']; // Fixed amount discount
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

    private function sendOrderMail($orderno)
    {
        $data['orders'] = DB::table('app_order_item')
            ->where('order_no', $orderno)
            ->where('user_id', Auth::user()->id)
            ->get()
            ->toArray();

        $data['address'] = DB::table('app_address')
            ->where('order_id', $data['orders'][0]->id)
            ->where('user_id', Auth::user()->id)
            ->orderBy('id', 'desc')
            ->first();

        DB::table('app_workshop')
            ->where('id', $data['orders'][0]->product_id)
            ->decrement('total_seat', 1);

        $data['name'] = Auth::user()->name;

        Mail::send('front.pages.email-file', $data, function ($message) {
            $message->to(Auth::user()->email, Auth::user()->name)
                ->subject('Order successful');
            $message->from('noreply@vscholar.in', 'VSCHOLAR');
        });
    }

    private function sendSuccessPurchase($orderno)
    {
        $data['orders'] = DB::table('app_order_item')
            ->where('order_no', $orderno)
            ->get()
            ->toArray();

        $data['name'] = Auth::user()->name;

        Mail::send('email.course-purchase', $data, function ($message) {
            $message->to(Auth::user()->email, Auth::user()->name)
                ->subject('Enrollment Successful');
            $message->from('noreply@vscholar.in', 'VSCHOLAR');
        });
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coupon;
use App\Models\Order;
use Cart;  // assuming a Cart facade or library is being used

class PaymentController extends Controller
{
    public function placeOrder(Request $request)
    {
        // Calculate subtotal and item-specific discounts from cart items
        $cartItems    = Cart::content();  // get all items in cart
        $subtotal     = 0;
        $itemDiscount = 0;
        foreach ($cartItems as $item) {
            $subtotal += $item->price * $item->quantity;
            // If item has an individual discount or an original price to compare
            if (isset($item->options['discount'])) {
                // Discount per item (e.g., stored in options)
                $itemDiscount += $item->options['discount'] * $item->quantity;
            } elseif (isset($item->original_price)) {
                // Difference between original price and discounted price
                $itemDiscount += ($item->original_price - $item->price) * $item->quantity;
            }
        }

        // Calculate coupon discount if a coupon code is applied
        $couponDiscount = 0;
        $couponCode = $request->input('coupon_code');
        if ($couponCode) {
            $couponDiscount = $this->calculateCouponDiscount($couponCode, $subtotal - $itemDiscount);
        }

        // Final amount = subtotal - item discounts - coupon discount
        $finalAmount = $subtotal - $itemDiscount - $couponDiscount;
        if ($finalAmount < 0) {
            $finalAmount = 0;
        }

        // Create a new Order record with all calculated values (including discounts)
        $order = new Order();
        $order->user_id         = auth()->id() ?? null;
        $order->subtotal        = $subtotal;
        $order->item_discount   = $itemDiscount;
        $order->coupon_discount = $couponDiscount;
        $order->total           = $finalAmount;
        $order->payment_method  = $request->input('payment_method');
        $order->status          = 'pending';  // set as pending until payment is confirmed
        $order->save();

        // If the chosen payment method is Razorpay, redirect to Razorpay payment handler
        if ($order->payment_method === 'razorpay') {
            // Store the final amount and order ID in session for RazorpayPaymentController
            session(['order_id' => $order->id, 'final_amount' => $finalAmount]);
            return redirect()->action([RazorpayPaymentController::class, 'pay']);
        } else {
            // Handle other payment methods (e.g., Cash on Delivery)
            if ($order->payment_method === 'cod') {
                $order->status = 'placed';  // order placed directly for COD
                $order->save();
            }
            // Clear the cart since the order is now placed
            Cart::destroy();
            return redirect()->route('order.success')->with('success', 'Order placed successfully!');
        }
    }

    /**
     * Calculate the discount amount for a given coupon code on a given amount.
     * This ensures the coupon discount is applied to the current total after item discounts.
     */
    private function calculateCouponDiscount($code, $amount)
    {
        $discount = 0;
        $coupon = Coupon::where('code', $code)->where('is_active', 1)->first();
        if ($coupon) {
            if ($coupon->type === 'fixed') {
                // Fixed amount coupon discount
                $discount = $coupon->value;
            } elseif ($coupon->type === 'percent') {
                // Percentage-based coupon discount
                $discount = ($amount * $coupon->value) / 100;
            }
            // Do not allow coupon discount to exceed the amount after item discounts
            if ($discount > $amount) {
                $discount = $amount;
            }
        }
        return $discount;
    }
}

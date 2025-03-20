<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Cart; // assuming a Cart facade or library is being used

class PaymentController extends Controller
{
    public function placeOrder(Request $request)
    {
        // Retrieve grand total from cart page (passed via hidden input)
        $grandTotal = $request->input('grand_total');

        // Ensure the total amount is not negative
        if ($grandTotal < 0) {
            $grandTotal = 0;
        }

        // Create a new Order record with the calculated values
        $order = new Order();
        $order->user_id        = auth()->id() ?? null;
        $order->total          = $grandTotal;
        $order->payment_method = $request->input('payment_method');
        $order->status         = 'pending'; // set as pending until payment is confirmed
        $order->save();

        // If the chosen payment method is Razorpay, redirect to Razorpay payment handler
        if ($order->payment_method === 'razorpay') {
            // Store the final amount and order ID in session for RazorpayPaymentController
            session(['order_id' => $order->id, 'final_amount' => $grandTotal]);
            return redirect()->action([RazorpayPaymentController::class, 'pay']);
        } else {
            // Handle other payment methods (e.g., Cash on Delivery)
            if ($order->payment_method === 'cod') {
                $order->status = 'placed'; // order placed directly for COD
                $order->save();
            }

            // Clear the cart since the order is now placed
            Cart::destroy();
            return redirect()->route('order.success')->with('success', 'Order placed successfully!');
        }
    }
}

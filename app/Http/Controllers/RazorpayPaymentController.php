<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Session;
use Exception;
use Auth;
use DB;
use Mail;

class RazorpayPaymentController extends Controller
{
    public function store(Request $request)
    {
        $input = $request->all();
        $api = new Api('rzp_live_EuNq2EgYEn62mD','Z2Y7fzKWagGz1HQsks9aUFHy');
        $payment = $api->payment->fetch($input['razorpay_payment_id']);

        if (count($input) && !empty($input['razorpay_payment_id'])) {
            try {
                $response = $api->payment->fetch($input['razorpay_payment_id'])->capture([
                    'amount' => $payment['amount']
                ]);
            } catch (Exception $e) {
                return redirect()->route('cart.list');
            }
        }

        $order_id = Session::get('order_id');
        $status = ($response->status === 'captured') ? 'Completed' : 'Failed';

        $payinfo = [
            'payment_status' => $status,
            'token' => $input['_token'],
            'payment_id' => $input['razorpay_payment_id'],
            'payment_update_date' => now(),
            'payment_date' => date('Y-m-d')
        ];

        // Send confirmation emails
        $this->sendOrderMail($order_id);
        $this->sendSuccessPurchase($order_id);

        // Update payment table
        DB::table('app_payment_info')
            ->where('order_id', $order_id)
            ->where('user_id', Auth::user()->id)
            ->update($payinfo);

        $request->session()->forget('order_id');
        \Cart::clear();

        session()->flash('success', 'Order Placed Successfully!');
        return redirect()->route('dashboard');
    }

    private function sendOrderMail($orderno)
    {
        $data['orders'] = DB::table('app_order_item')
            ->where('order_no', $orderno)
            ->where('user_id', Auth::user()->id)
            ->get()
            ->toArray();

        $data['address'] = DB::table('app_address')
            ->where('order_id', $data['orders']->id ?? null)
            ->where('user_id', Auth::user()->id)
            ->orderBy('id', 'desc')
            ->first();

        $product_id = $data['orders'][0]->product_id;
        $seat_left = DB::table('app_workshop')->where('id', $product_id)->first();

        if ($seat_left) {
            $new_seat_left = max(0, $seat_left->total_seat - 1);
            DB::table('app_workshop')->where('id', $product_id)->update(['total_seat' => $new_seat_left]);
        }

        $data['name'] = Auth::user()->name;

        Mail::send('front.pages.email-file', $data, function ($message) {
            $message->to(Auth::user()->email, Auth::user()->name)
                ->subject('Order successful');
            $message->from('noreply@VIEFSCHOLAR.in', 'Acad Buddy');
        });
    }

    private function sendSuccessPurchase($orderno = "")
    {
        $data['orders'] = DB::table('app_order_item')
            ->where('order_no', $orderno)
            ->get()
            ->toArray();

        $data['workshop'] = DB::table('app_workshop')
            ->where('id', $data['orders'][0]->product_id ?? null)
            ->first();

        $data['address'] = DB::table('app_address')
            ->where('order_id', $data['orders']->id ?? null)
            ->orderBy('id', 'desc')
            ->first();

        $data['name'] = Auth::user()->name;

        Mail::send('email.course-purchase', $data, function ($message) {
            $message->to(Auth::user()->email, Auth::user()->name)
                ->subject('Enrollment Successful');
            $message->from('noreply@VIEFSCHOLAR.in', 'Acad Buddy');
        });
    }
}

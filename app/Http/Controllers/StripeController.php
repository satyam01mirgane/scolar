<?php

namespace App\Http\Controllers;
    
use Illuminate\Http\Request;
use Session;
use Stripe;
use DB;
    
class StripeController extends Controller
{
    protected $secretkey = 'sk_test_51HUlDLAlbI1shHGXaEqfFYq07dDj5W24qf0ZL6rabP8Ucp8Uj3JvVHJ1dZReyLTfqksxPyf6bQhKW1N6JAj7WwSV00KczXdRAB';
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe()
    {
        return view('stripe');
    }
   
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {
        try{
            Stripe\Stripe::setApiKey($this->secretkey);
            $payamount = 500;
            Stripe\Charge::create ([
                    "amount" => $payamount,
                    "currency" => "usd",
                    "source" => $request->stripeToken,
                    "description" => "Purchase of ".$request->class_title
            ]);

            $payment_status = ($request->stripeToken)?'Success':'Failed';
            $unique_id = md5(uniqid(mt_rand(), true));
            $paydata = [
                        'class_id'=>base64_decode($request->course_id),
                        'order_id'=>$unique_id,
                        'signup_id'=>base64_decode($request->signupId),
                        'course_title'=>$request->class_title,
                        'pay_amount'=>$payamount,
                        'currency'=>'usd',
                        'pay_status'=>$payment_status,
                        'token'=>$request->stripeToken,
                        'paydesc'=>'Purchase of '.$request->class_title,
                        'payment_date'=>date('Y-m-d H:i:s'),
            ];

            $ins = DB::table('app_payment')->insert($paydata);
            if($ins){
                $this->sendOrderEmail($paydata);
                DB::table('app_course_signup')->where('id',base64_decode($request->signupId))->update(['payment_status'=>$payment_status,'payment_date'=>date('Y-m-d H:i:s'),'plan_price'=>$payamount]);
                Session::flash('success', 'Payment successful!');
                return back();
            }else{
                Session::flash('error', 'Payment failed!');
                return back();
            }
        }catch(\Exception $e){
            Session::flash('error', 'Payment failed, please try again!');
            return back();
        }
    }

    private function sendOrderEmail($data){
        $order_details = DB::table('app_course_signup')->where('id',$data['signup_id'])->first();
        # FIX: Replace this email with recipient email
        $mail_to = $order_details->email;
        $email = 'noreply@inneryoga.com';
        # Sender Data
        $subject = 'Dear, '.$order_details->name.'thanks for your otder- '.$data['paydesc'];
        $orderId = $data['order_id'];
        $price = $data['pay_amount'];
        
        
        # Mail Content
        $content = "Order Id: $orderId\n";
        $content .= "Price: $price\n\n";

        # email headers.
        $headers = "From: $name <$email>";

        # Send the email.
        //$success = mail($mail_to, $subject, $content, $headers);
    }
}

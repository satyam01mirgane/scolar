<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use View;
use Session;
use Redirect;
use Auth;
use DB;


class PaymentController extends Controller
{
    public function index()
    {
        return view('event');
    }
    public function payment(Request $request)
    { 
        $this->validate($request, [
            'amount' => 'required',
            'purpose' => 'required',
            'buyer_name' => 'required',
            'phone' => 'required',
        ]);
        
        $ch = curl_init();

        // For Live Payment change CURLOPT_URL to https://www.instamojo.com/api/1.1/payment-requests/
       
        curl_setopt($ch, CURLOPT_URL, 'https://test.instamojo.com/api/1.1/payment-requests/');
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER,
            array("X-Api-Key:test_ae53f792514dcd2e45af91a6cdf",
                "X-Auth-Token:test_fecc2b6dbfefbdb171cdea243ec"));
        $payload = Array(
            'purpose' => $request->get('purpose'),
            'amount' => $request->get('amount'),
            'phone' => $request->get('phone'),
            'buyer_name' => $request->get('buyer_name'),
            'redirect_url' => url('/returnurl'),
            'send_email' => false,
            'webhook' => 'http://instamojo.com/webhook/',
            'send_sms' => true,
            'email' => 'laracode101@gmail.com',
            'allow_repeated_payments' => false
        );
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
        $response = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch); 
		
        if ($err) {
            \Session::put('error',$err.'Payment Failed, Try Again!!');
            return redirect()->back();
        } else {
            $data = json_decode($response);
        }
		//dd($data);

        if($data->success == true) {
            return redirect($data->payment_request->longurl);
        } else { 
            \Session::put('error','Payment Failed, Try Again!!');
            return redirect()->back();
        }

    }

    public function returnurl(Request $request)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://test.instamojo.com/api/1.1/payments/'.$request->get('payment_id'));
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER,
            array("X-Api-Key:test_ae53f792514dcd2e45af91a6cdf",
                "X-Auth-Token:test_fecc2b6dbfefbdb171cdea243ec"));

        $response = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch); 

        if ($err) {
            \Session::put('error','Payment Failed, Try Again!!');
            return redirect()->route('payment');
        } else {
            $data = json_decode($response);
        }
   
        if($data->success == true) {
            if($data->payment->status == 'Credit') {
                
                // From here you can save respose data in database from $data
				$response_data = DB::table('student_course')->insert([
						'student_id'=>Auth::user()->id,
						'course_id'=>Session::get('courseid'),
						'course_type'=>Session::get('cousretype'),
						'status'=>$data->payment->status,
						'payment_id'=>$data->payment->payment_id,
						'currency'=>$data->payment->currency,
						'amount'=>$data->payment->amount,
						'buyer_name'=>$data->payment->buyer_name,
						'buyer_phone'=>$data->payment->buyer_phone,
						'buyer_email'=>$data->payment->buyer_email,
						'shipping_address'=>$data->payment->shipping_address,
						'shipping_city'=>$data->payment->shipping_city,
						'shipping_state'=>$data->payment->shipping_state,
						'shipping_zip'=>$data->payment->shipping_zip,
						'shipping_country'=>$data->payment->shipping_country,
						'quantity'=>$data->payment->quantity,
						'unit_price'=>$data->payment->unit_price,
						'fees'=>$data->payment->fees,
						'affiliate_commission'=>$data->payment->affiliate_commission,
						'payment_request'=>$data->payment->payment_request,
						'instrument_type'=>$data->payment->instrument_type,
						'billing_instrument'=>$data->payment->billing_instrument,
						'tax_invoice_id'=>$data->payment->tax_invoice_id,
						'created_at'=>$data->payment->created_at,
				]);
				session()->put('courseid', '');
				session()->put('cousretype', '');
                \Session::put('success','Your payment has been pay successfully, Enjoy!!');
                return redirect()->route('payment');

            } else {
                \Session::put('error','Payment Failed, Try Again!!');
                return redirect()->route('payment');
            }
        } else {
            \Session::put('error','Payment Failed, Try Again!!');
            return redirect()->route('payment');
        }
    }

}

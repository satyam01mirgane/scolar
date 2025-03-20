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
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function store(Request $request)
    {
        $input = $request->all();
        //$api = new Api('rzp_test_vPpKZ6HJO3H88P','BRq2br6TnuxyikKjmn7DQUVn');
        $api = new Api('rzp_live_EuNq2EgYEn62mD','Z2Y7fzKWagGz1HQsks9aUFHy');
  
        $payment = $api->payment->fetch($input['razorpay_payment_id']);
		

        if(count($input)  && !empty($input['razorpay_payment_id'])) {
            try {
                $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount'=>$payment['amount'])); 
            } catch (Exception $e) {
                //return  $e->getMessage();
				//dd($e->getMessage());
                //\Session::put('error',$e->getMessage());
                return redirect()->route('cart.list');
            }
        }
			$order_id = Session::get('order_id');
			$status = '';
			if($response->status=='captured'){
				$status = 'Completed';
			}else{
				$status = 'Failed';
			}
			$payinfo = [
							'payment_status'=>$status,
							'token'=>$input['_token'],
							'payment_id'=>$input['razorpay_payment_id'],
							'payment_update_date'=>date('Y-m-d H:i:s'),
							'payment_date'=>date('Y-m-d')
							
				];
			
				$this->sendOrderMail($order_id);
				$this->sendSuccessPurchase($order_id);
			
			//Update payment table
			DB::table('app_payment_info')->where('order_id',$order_id)->where('user_id',Auth::user()->id)->update($payinfo);
			$request->session()->forget('order_id');	
			\Cart::clear();
			session()->flash('success', 'Order Placed Successfully !');
			return redirect()->route('dashboard');
    }
	
	
	
	
    private function sendOrderMail($orderno){
		//$orderno = 'ORD00000184';
		$data['orders'] = DB::table('app_order_item')->where('order_no',$orderno)->where('user_id',Auth::user()->id)->get()->toArray();
		$data['address'] = DB::table('app_address')->where('order_id',$data['orders']->id)->where('user_id',Auth::user()->id)->orderBy('id','desc')->first();
		
		$product_id = $data['orders'][0]->product_id;
		$seat_left = DB::table('app_workshop')->where('id',$product_id)->first();
		$old_seat_left = 0;
		$new_seat_left = 0;
		if(isset($seat_left)){
			$old_seat_left = $seat_left->total_seat;
			$new_seat_left = $old_seat_left - 1;
			if($new_seat_left < 0){
				$new_seat_left = 0;
			}
		}
		DB::table('app_workshop')->where('id',$product_id)->update(['total_seat'=>$new_seat_left]);
		
		$data['name']= Auth::user()->name;
		Mail::send('front.pages.email-file', $data, function($message) {
         $message->to(Auth::user()->email, Auth::user()->name)->subject
            ('Order successfull');
         $message->from('noreply@ VIEF SCHOLAR .in','Acad Buddy');
		});
	}
	
	private function sendSuccessPurchase($orderno=""){
		$data['orders'] = DB::table('app_order_item')->where('order_no',$orderno)->get()->toArray();
		$data['workshop'] = DB::table('app_workshop')->where('id',$data['orders'][0]->product_id)->first();
		$data['address'] = DB::table('app_address')->where('order_id',$data['orders']->id)->orderBy('id','desc')->first();
		$data['name']= Auth::user()->name;
		Mail::send('email.course-purchase', $data, function($message) {
         $message->to(Auth::user()->email, Auth::user()->name)->subject
            ('Enrollment Successfull');
         $message->from('noreply@ VIEF SCHOLAR .in','Acad Buddy');
		});
	}
	
	/*private function sendOrderMail($order_id){
		//$orders = Order::with('orderItem')->where('id',$order_id)->where('user_id',Auth::user()->id)->first();
		$orderItem = DB::table('app_order_item')->where('order_no',$order_id)->where('user_id',Auth::user()->id)->get()->toArray();
		
		$to = Auth::user()->email;
		$from = 'noreply@ VIEF SCHOLAR .in';
		$order_no = $orderItem[0]->order_no;
		$order_total = $orderItem[0]->sub_total;
		$subject = 'Dear '.Auth::user()->name.' Thanks For Enrollment, Your Purchase Is Successfull';
		$billing_address = $address->billing_fname.' '.$address->billing_lname.','.$address->billing_address1.','.$address->billing_address2.','.$address->billing_city.','.$address->billing_district.','.$address->billing_country.','.$address->billing_zip.','.$address->billing_lanmark;
		$shipping_address = $address->shipping_fname.' '.$address->shipping_lname.','.$address->shipping_address1.','.$address->shipping_address2.','.$address->shipping_city.','.$address->shipping_district.','.$address->shipping_country.','.$address->shipping_zip.','.$address->shipping_landmark;
		

		$headers = "From: $from";
		$headers = "From: " . $from . "\r\n";
		$headers .= "Reply-To: ". $from . "\r\n";
		$headers .= 'Bcc: accounts@ VIEF SCHOLAR .in' . "\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

		//$subject = "Order Successfull";

		$logo = 'https:// VIEF SCHOLAR .in/uploads/1/2022-09/logo.svg';
		$link = 'https:// VIEF SCHOLAR .in/';

		$body = "<!DOCTYPE html><html lang='en'><head><meta charset='UTF-8'><title>Workshop Enrollment Success</title>";
		$body = "</head><body>";
		$body .= "<table style='width: 100%;'>";
		$body .= "<thead style='text-align: center;'><tr><td style='border:none;' colspan='2'>";
		$body .= "<a href='{$link}'><img src='{$logo}' alt='' width='150' style='background-color:#000;'></a><br><br>";
		$body .= "</td></tr></thead><tbody><tr>";
		$body .= "<td style='border:none;'><strong>Order No:</strong> {$order_no}</td>";
		$body .= "<td style='border:none;'><strong>Order Total:Rs.</strong> {$order_total}</td>";
		$body .= "</tr>";
		$body .= "</tbody></table>";
		$body .= "</body>";
		$body .= '<div  style="overflow: hidden; outline: none;" tabindex="0">';
		$body .='<h5>Order Details</h5>';
		$body .= '<table style="font-family: Arial, Helvetica, sans-serif; border-collapse: collapse;width: 100%;">';
			$body .= '<thead>';
				$body .= '<tr>';
					$body .= '<th style="border: 1px solid #ddd;padding: 8px;">Course</th>';
					$body .= '<th style="border: 1px solid #ddd;padding: 8px;">Price</th>';
					$body .= '<th style="border: 1px solid #ddd;padding: 8px;">Qty</th>';
					$body .= '<th style="border: 1px solid #ddd;padding: 8px;">Total</th>';
				$body .= '</tr>';
			$body .= '</thead>';
			$body .= '<tbody>';
			$total = 0;
				foreach($orderItem as $k=>$v){
				    $total = $total + $v->product_price;
				$body .= '<tr>';
					$body .= '<td style="border: 1px solid #ddd;padding: 8px;text-align:center;">'.$v->product_name.'</td>';
					$body .= '<td style="border: 1px solid #ddd;padding: 8px;text-align:center;">₹'.$v->product_price.'</td>';
					$body .= '<td style="border: 1px solid #ddd;padding: 8px;text-align:center;">'.$v->product_qunatity.'</td>';
					$body .= '<td style="border: 1px solid #ddd;padding: 8px;text-align:center;">₹'.$v->sub_total.'</td>';
				$body .= '</tr>';
				}
			$body .= '</tbody>';
			$body .= '<tfoot>';
				$body .= '<tr>';
					$body .= '<th colspan="3" class="text-right">Sub Total:</th>';
					$body .= '<th class="text-center">Rs.'.$total.'</th>';
				$body .= '</tr>';
				$body .= '<tr>';
					$body .= '<th colspan="3" class="text-right">Total:</th>';
					$body .= '<th class="text-center">Rs.'.$total.'</th>';
				$body .= '</tr>';
			$body .= '</tfoot>';
		$body .= '</table>';
	$body .= '</div>';
		$body .="</html>";
		$success = mail($to, $subject, $body, $headers);
		return $success;
	}*/
	
}

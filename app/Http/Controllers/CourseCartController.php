<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Session;

class CourseCartController extends Controller
{
    public function cartList()
    {
        $cartItems = \Cart::getContent();
        return view('front.pages.cart', compact('cartItems'));
    }


    public function addToCart(Request $request)
    {
        \Cart::add([
            'id' => $request->id,
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'discount' => $request->discount,
            'attributes' => array(
                'image' => $request->image,
            )
        ]);
        //session()->flash('success', 'Product is Added to Cart Successfully !');
		if($request->btnname=='cart'){
			return redirect()->back()->with('message','Product is Added to Cart Successfully !');
		}else{
			return redirect()->route('cart.list');
		}
    }

    public function updateCart(Request $request)
    {
        \Cart::update(
            $request->id,
            [
                'quantity' => [
                    'relative' => false,
                    'value' => $request->quantity
                ],
            ]
        );

        session()->flash('success', 'Item Cart is Updated Successfully !');

        return redirect()->route('cart.list');
    }

    public function removeCart(Request $request)
    {
        \Cart::remove($request->id);
        session()->flash('success', 'Item Cart Remove Successfully !');

        return redirect()->route('cart.list');
    }

    public function clearAllCart()
    {
        \Cart::clear();

        session()->flash('success', 'All Item Cart Clear Successfully !');

        return redirect()->route('cart.list');
    }
	
	public function checkout(Request $request)
    {
		if(!isset(Auth::user()->id)){
			session()->flash('error', 'Please login first to proceed checkout !');
			return redirect()->route('login');
		}
		$get_address = DB::table('app_address')->where('user_id',Auth::user()->id)->orderBy('id','desc')->first();
		//dd($get_address);
		$country = DB::table('tbl_countries')->orderBy('name','asc')->get();
		$state = DB::table('tbl_states')->where('country_id',$get_address->billing_country_id)->get();
		$city = DB::table('tbl_cities')->where('state_id',$get_address->billing_state_id)->get();
		
        $cartItems = \Cart::getContent();
        return view('front.pages.checkout', compact('cartItems','get_address','country','state','city'));
    }
	
	public function processOrder(Request $request){
		if(!isset(Auth::user()->id)){
			session()->flash('error', 'Please login first to proceed checkout !');
			return redirect()->route('login');
		}
		//Order count fetch
		$order_count = DB::table('app_ordercount')->where('id',1)->first();
		$order_no = 'ORD'.str_pad($order_count->count + 1, 8, "0", STR_PAD_LEFT);

		$user_id = Auth::user()->id;
		
		
		
		$shipping_charge = 0;
		$total_amount = \Cart::getTotal();
		$total_amount  = $total_amount + $shipping_charge;
		$order_status = ($request->payment_mode=='cod')?'Completed':'Pending';
		
		//Save cart data to order item
		$cartItems = \Cart::getContent();
		foreach($cartItems as $k=>$v){
			$orderInfo =[
							'order_no'=>$order_no,
							'user_id'=>$user_id,
							'product_id'=>$v->id,
							'product_name'=>$v->name,
							'product_image'=>$v->attributes->image,
							'product_price'=>$v->price,
							'product_qunatity'=>$v->quantity,
							'product_discount'=>0,
							'sub_total'=>$v->quantity * $v->price ,
						];
			DB::table('app_order_item')->insert($orderInfo);
		}
		
		$payinfo = [
					'user_id'=>$user_id,
					'order_id'=>$order_no,
					'payment_status'=>$order_status,
					'payment_date'=>date('Y-m-d'),
					'payment_amount'=>$total_amount,
					
		];
		
		//Update payment table
		DB::table('app_payment_info')->insert($payinfo);
		//Update order count
		$updcount = $order_count->count + 1;
		DB::table('app_ordercount')->where('id',1)->update(['count'=>$updcount]);
		
		if($total_amount ==0){
			$payinfo = [
							'payment_status'=>'Completed',
							'token'=>'No token for free workshop',
							'payment_id'=>'Free Workshop',
							'payment_update_date'=>date('Y-m-d H:i:s'),
							'payment_date'=>date('Y-m-d')
				];
			
			$this->sendOrderMail($order_no);
			
			//Update payment table
			DB::table('app_payment_info')->where('order_id',$order_no)->where('user_id',Auth::user()->id)->update($payinfo);
			//$request->session()->forget('order_id');	
			\Cart::clear();
			session()->flash('success', 'Order Placed Successfully !');
			return redirect()->route('dashboard');
		}
		\Session::put('order_id', $order_no);
		return view('front.pages.complete-payment');
		
		
	}
	private function sendOrderMail($order_id){
		//$orders = Order::with('orderItem')->where('id',$order_id)->where('user_id',Auth::user()->id)->first();
		$orderItem = DB::table('app_order_item')->where('order_no',$order_id)->where('user_id',Auth::user()->id)->first();
		
		$to = Auth::user()->email;
		$from = 'noreply@vscholar.in';
		$order_no = $orderItem->order_no;
		$order_total = $orderItem->sub_total;
		$subject = 'Dear '.Auth::user()->name.' Thanks For Enrollment, Your Purchase Is Successfull';
		$billing_address = $address->billing_fname.' '.$address->billing_lname.','.$address->billing_address1.','.$address->billing_address2.','.$address->billing_city.','.$address->billing_district.','.$address->billing_country.','.$address->billing_zip.','.$address->billing_lanmark;
		$shipping_address = $address->shipping_fname.' '.$address->shipping_lname.','.$address->shipping_address1.','.$address->shipping_address2.','.$address->shipping_city.','.$address->shipping_district.','.$address->shipping_country.','.$address->shipping_zip.','.$address->shipping_landmark;
		

		$headers = "From: $from";
		$headers = "From: " . $from . "\r\n";
		$headers .= "Reply-To: ". $from . "\r\n";
		$headers .= 'Bcc: accounts@ VSCHOLAR .in' . "\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

		//$subject = "Order Successfull";

		$logo = 'https:// VSCHOLAR .in/uploads/1/2022-09/logo.svg';
		$link = 'https:// VSCHOLAR .in/';

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
				//foreach($orderItem as $k=>$v){
				$body .= '<tr>';
					$body .= '<td style="border: 1px solid #ddd;padding: 8px;text-align:center;">'.$orderItem->product_name.'</td>';
					$body .= '<td style="border: 1px solid #ddd;padding: 8px;text-align:center;">₹'.$orderItem->product_price.'</td>';
					$body .= '<td style="border: 1px solid #ddd;padding: 8px;text-align:center;">'.$orderItem->product_qunatity.'</td>';
					$body .= '<td style="border: 1px solid #ddd;padding: 8px;text-align:center;">₹'.$orderItem->sub_total.'</td>';
				$body .= '</tr>';
				//}
			$body .= '</tbody>';
			$body .= '<tfoot>';
				$body .= '<tr>';
					$body .= '<th colspan="3" class="text-right">Sub Total:</th>';
					$body .= '<th class="text-center">Rs.'.$orderItem->sub_total.'</th>';
				$body .= '</tr>';
				$body .= '<tr>';
					$body .= '<th colspan="3" class="text-right">Total:</th>';
					$body .= '<th class="text-center">Rs.'.$orderItem->sub_total.'</th>';
				$body .= '</tr>';
			$body .= '</tfoot>';
		$body .= '</table>';
	$body .= '</div>';
		$body .="</html>";
		$success = mail($to, $subject, $body, $headers);
		return $success;
	}
}

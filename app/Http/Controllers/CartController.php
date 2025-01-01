<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Session;
use Razorpay\Api\Api;
use Mail;

class CartController extends Controller
{
    public function cartList()
    {
		if(!isset(Auth::user()->id)){
			session()->flash('error', 'Please login to see cart !');
			return redirect()->route('login');
		}
        $cartItems = \Cart::getContent();
        return view('front.pages.cart', compact('cartItems'));
    }


    public function addToCart(Request $request)
    {
		if(!isset(Auth::user()->id)){
			session()->flash('error', 'Please login to add cart!');
			return redirect()->route('login');
		}
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
		if(!isset(Auth::user()->id)){
			session()->flash('error', 'Please login first to proceed checkout !');
			return redirect()->route('login');
		}
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
		$udis = 0;
		$total_dis = 0;
		$total_amount_ch = 0;
		foreach($cartItems as $k=>$v){
			$product_arr = explode('-',$v->name);
			
			$udis = calculate_discount($v->id);
			$total_amount_ch = $v->quantity * $v->price;
			$total_dis = $total_amount_ch - $udis;
			
			$orderInfo =[
							'order_no'=>$order_no,
							'user_id'=>$user_id,
							'product_id'=>$v->id,
							'product_name'=>$product_arr[0],
							'product_image'=>$v->attributes->image,
							'product_price'=>$v->price,
							'product_qunatity'=>$v->quantity,
							'product_discount'=>$udis,
							'type'=>$product_arr[1],
							'sub_total'=> $total_dis,
						];
			DB::table('app_order_item')->insert($orderInfo);
		}
		if($total_amount > 0){
			$api = new Api('rzp_live_lP2LYJNlqAhhTs','jjn6moAvZe1tYKZ5ZgVN6GIM');
			$orderData = ['receipt' => $order_no,'amount'=> $total_dis*100,'currency' => 'INR','partial_payment' => true];
			$razorpayOrder = $api->order->create($orderData);
			
			$payinfo = [
						'user_id'=>$user_id,
						'rz_order_id'=>$razorpayOrder->id,
						'order_id'=>$order_no,
						'payment_status'=>$order_status,
						'payment_date'=>date('Y-m-d'),
						'payment_amount'=>$total_amount_ch,
						
			];
			
			//Update payment table
			DB::table('app_payment_info')->insert($payinfo);
		}
		//Update order count
		$updcount = $order_count->count + 1;
		DB::table('app_ordercount')->where('id',1)->update(['count'=>$updcount]);
		
		
		
		if($total_amount ==0){
				$payinfo = [
							'user_id'=>Auth::user()->id,
							'order_id'=>$order_no,
							'payment_status'=>'Completed',
							'payment_amount'=>'0.00',
							'token'=>'No token for free workshop',
							'payment_id'=>'Free Workshop',
							'payment_update_date'=>date('Y-m-d H:i:s'),
							'payment_date'=>date('Y-m-d')
				];
			
			$this->sendOrderMail($order_no);
			$this->sendSuccessPurchase($order_no);
			
			//Update payment table
			DB::table('app_payment_info')->insert($payinfo);
			//$request->session()->forget('order_id');	
			\Cart::clear();
			session()->flash('success', 'Order Placed Successfully !');
			return redirect()->route('dashboard');
		}
		\Session::put('order_id', $order_no);
		$cartItems = \Cart::getContent();
		return view('front.pages.complete-payment', compact('cartItems'));
		
		
	}
	
	private function sendOrderMail($orderno){
		$data['orders'] = DB::table('app_order_item')->where('order_no',$orderno)->where('user_id',Auth::user()->id)->get()->toArray();
		$data['address'] = DB::table('app_address')->where('order_id',$data['orders']->id)->where('user_id',Auth::user()->id)->orderBy('id','desc')->first();
		$data['name']= Auth::user()->name;
		Mail::send('front.pages.email-file', $data, function($message) {
         $message->to(Auth::user()->email, Auth::user()->name)->subject
            ('Order successfull');
			$message->from('noreply@vscholar.in','VSCHOLAR');
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
			$message->from('noreply@vscholar.in','VSCHOLAR');
		});
	}
}

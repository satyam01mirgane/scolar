<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\User;
use Illuminate\Support\Facades\Hash;
use App\Order;

class DashboardController extends Controller
{
    public function __construct() 
	{
		$this->middleware('auth');
	}
	
	public function account(){
		$data = array();
		$data['menu1'] = 'active';
		$data['menu2'] = '';
		$data['menu3'] = '';
		$data['menu4'] = '';
		$data['menu5'] = '';
		$data['menu6'] = '';
		$data['menu7'] = '';
		$data['user_profile'] = DB::table('users')->where('id',Auth::user()->id)->first();
		return view('front.pages.user-account',$data);
	}
	
	public function profileEdit(){
		$data = array();
		$data['menu1'] = 'active';
		$data['menu2'] = '';
		$data['menu3'] = '';
		$data['menu4'] = '';
		$data['menu5'] = '';
		$data['menu6'] = '';
		$data['menu7'] = '';
		$data['user_profile'] = DB::table('users')->where('id',Auth::user()->id)->first();
		return view('front.pages.user-edit',$data);
	}
	
	public function scheduledWorkshop(){
		$data = array();
		$data['menu1'] = '';
		$data['menu2'] = '';
		$data['menu3'] = '';
		$data['menu4'] = 'active';
		$data['menu5'] = '';
		$data['menu6'] = '';
		$data['menu7'] = '';
		$orders = DB::table('app_order_item')
            ->join('app_workshop', 'app_workshop.id', '=', 'app_order_item.product_id')
            ->leftjoin('app_trainer', 'app_trainer.id', '=', 'app_workshop.trainer_id')
			->leftjoin('app_payment_info', 'app_payment_info.order_id', '=', 'app_order_item.order_no')
			->where('session_date','>',date('Y-m-d'))
			->where('app_order_item.user_id','=',Auth::user()->id)
			->where('app_order_item.type','=','Workshop')
			->where('app_payment_info.payment_status','=','Completed')
            ->select('app_order_item.*', 'app_workshop.name as workshopname','app_workshop.workshop_type as workshop_type','app_workshop.image',
			'app_workshop.price','app_workshop.zoom_link','app_workshop.session_date','app_workshop.video_link',
			'app_workshop.session_time','app_workshop.session_status', 'app_trainer.name as trainername')
            ->get();
		//dd($orders);
		$data['orders'] = $orders;
		return view('front.pages.scheduled-list',$data);
	}
	
	
	public function scheduledCourse(){
		$data = array();
		$data['menu1'] = '';
		$data['menu2'] = '';
		$data['menu3'] = '';
		$data['menu4'] = '';
		$data['menu5'] = '';
		$data['menu6'] = '';
		$data['menu7'] = 'active';
		$orders = DB::table('app_order_item')
            ->join('app_workshop', 'app_workshop.id', '=', 'app_order_item.product_id')
            ->leftjoin('app_trainer', 'app_trainer.id', '=', 'app_workshop.trainer_id')
			->leftjoin('app_payment_info', 'app_payment_info.order_id', '=', 'app_order_item.order_no')
			#->where('session_date','>',date('Y-m-d'))
			->where('app_order_item.user_id','=',Auth::user()->id)
			->where('app_order_item.type','!=','Workshop')
			->where('app_payment_info.payment_status','=','Completed')
            ->select('app_order_item.*', 'app_workshop.name as workshopname','app_workshop.workshop_type as workshop_type','app_workshop.image',
			'app_workshop.price','app_workshop.zoom_link','app_workshop.session_date','app_workshop.video_link',
			'app_workshop.session_time','app_workshop.session_status', 'app_trainer.name as trainername')
            ->get();
		//dd($orders);
		$data['orders'] = $orders;
		return view('front.pages.scheduled-course',$data);
	}
	
	public function certificateFeedback(){
		$data = array();
		$data['menu1'] = '';
		$data['menu2'] = '';
		$data['menu3'] = '';
		$data['menu4'] = '';
		$data['menu5'] = 'active';
		$data['menu6'] = '';
		$data['menu7'] = '';
		$orders = DB::table('app_order_item')
            ->join('app_workshop', 'app_workshop.id', '=', 'app_order_item.product_id')
            ->leftjoin('app_trainer', 'app_trainer.id', '=', 'app_workshop.trainer_id')
            ->leftjoin('app_feedback', 'app_workshop.id', '=', 'app_feedback.workshop_id')
			->leftjoin('app_payment_info', 'app_payment_info.order_id', '=', 'app_order_item.order_no')
			->where('app_order_item.user_id','=',Auth::user()->id)
			#->where('app_order_item.type','=','Workshop')
			->where('app_payment_info.payment_status','=','Completed')
            ->select('app_order_item.*', 'app_workshop.name as workshopname','app_workshop.image',
			'app_workshop.price','app_workshop.zoom_link','app_workshop.session_date','app_workshop.video_link',
			'app_workshop.session_time','app_workshop.session_status', 'app_trainer.name as trainername','app_feedback.topic_suggestion as feedback')
            ->get();
		//dd($orders);
		$data['orders'] = $orders;
		return view('front.pages.certificate-feedback',$data);
	}
	
	public function printCertificate($id){
		$data = array();
		$data['menu1'] = '';
		$data['menu2'] = '';
		$data['menu3'] = '';
		$data['menu4'] = '';
		$data['menu5'] = 'active';
		$data['menu6'] = '';
		$data['menu7'] = '';
		$orders = DB::table('app_order_item')
            ->join('app_workshop', 'app_workshop.id', '=', 'app_order_item.product_id')
            ->leftjoin('app_trainer', 'app_trainer.id', '=', 'app_workshop.trainer_id')
            ->leftjoin('app_feedback', 'app_workshop.id', '=', 'app_feedback.workshop_id')
			->where('app_workshop.id','=',$id)
			#->where('app_order_item.type','=','Workshop')
            ->select('app_order_item.*', 'app_workshop.name as workshopname','app_workshop.image',
			'app_workshop.price','app_workshop.zoom_link','app_workshop.session_date',
			'app_workshop.session_time','app_workshop.session_status', 'app_trainer.name as trainername','app_feedback.topic_suggestion as feedback')
            ->first();
		//dd($orders);
		$data['orders'] = $orders;
		return view('front.pages.certificate',$data);
	}
	
	public function feedback(Request $request){
		$ins=DB::table('app_feedback')->insert(['user_id'=>Auth::user()->id,'workshop_id'=>$request->wpid,
		'name'=>$request->name,'email'=>$request->email,'phone'=>$request->phone,'certificate_name'=>$request->cname,
		'overall_experience'=>$request->workshop_rate,'enjoyed_workshop'=>$request->workshop_exp,'content_rate'=>$request->content_rate,'instructor_rate'=>$request->instructor_skill,'topic_suggestion'=>$request->topic_suggest,'any_suggestion'=>$request->other_suggest]);
		session()->flash('success', 'Feedback submitted successfully !');
		return redirect()->back();
	}
	
	public function changePassword(){
		$data = array();
		$data['menu1'] = '';
		$data['menu2'] = 'active';
		$data['menu3'] = '';
		$data['menu4'] = '';
		$data['menu5'] = '';
		$data['menu6'] = '';
		$data['menu7'] = '';
		$data['user_profile'] = DB::table('users')->where('id',Auth::user()->id)->first();
		\Session::put('error','');
		return view('front.pages.change-password',$data);
	}
	
	public function updatePassword(Request $request){
		$user = User::findOrFail(Auth::user()->id);
		$this->validate($request, [
			'old_pass' => 'required',
			'password' => 'required',
			'new_password' => 'required_with:password|same:password|min:6'
		]);

		if (Hash::check($request->old_pass, $user->password)) { 
		   $user->fill([
			'password' => Hash::make($request->new_password)
			])->save();

		   $request->session()->flash('success', 'Password changed');
			return redirect()->route('change-password');

		} else {
			$request->session()->flash('error', 'Password does not match');
			return redirect()->route('change-password');
		}
	}
	
	public function orderList(){
		$data = array();
		$data['menu1'] = '';
		$data['menu2'] = '';
		$data['menu3'] = 'active';
		$data['menu4'] = '';
		$data['menu5'] = '';
		$data['menu6'] = '';
		$data['menu7'] = '';
		//$data['orders'] = Order::with('orderItem','orderPayment')->where('user_id',Auth::user()->id)->orderBy('id','desc')->get();
		$orders = DB::table('app_order_item')
            ->join('app_workshop', 'app_workshop.id', '=', 'app_order_item.product_id')
            ->leftjoin('app_trainer', 'app_trainer.id', '=', 'app_workshop.trainer_id')
			->leftjoin('app_payment_info', 'app_payment_info.order_id', '=', 'app_order_item.order_no')
			#->where('session_date','<',date('Y-m-d'))
			->where('app_order_item.user_id','=',Auth::user()->id)
			->where('app_order_item.type','=','Workshop')
			->where('app_payment_info.payment_status','=','Completed')
            ->select('app_order_item.*', 'app_workshop.name as workshopname','app_workshop.image',
			'app_workshop.price','app_workshop.zoom_link','app_workshop.session_date','app_workshop.video_link',
			'app_workshop.session_time','app_workshop.session_status', 'app_trainer.name as trainername')
            ->get();
		//dd($orders);
		$data['orders'] = $orders;
		return view('front.pages.order-list',$data);
	}
	
	public function courseList(){
		$data = array();
		$data['menu1'] = '';
		$data['menu2'] = '';
		$data['menu3'] = '';
		$data['menu4'] = '';
		$data['menu5'] = '';
		$data['menu6'] = 'active';
		$data['menu7'] = '';
			$orders = DB::table('app_order_item')
            ->join('app_workshop', 'app_workshop.id', '=', 'app_order_item.product_id')
            ->leftjoin('app_payment_info', 'app_order_item.order_no', '=', 'app_payment_info.order_id')
            ->leftjoin('app_trainer', 'app_trainer.id', '=', 'app_workshop.trainer_id')
			#->where('session_date','<',date('Y-m-d'))
			->where('app_order_item.user_id','=',Auth::user()->id)
			->where('app_order_item.type','!=','Workshop')
			->where('app_payment_info.payment_status','==','Completed')
            ->select('app_order_item.*','app_payment_info.payment_status', 'app_workshop.name as workshopname','app_workshop.image',
			'app_workshop.price','app_workshop.zoom_link','app_workshop.session_date',
			'app_workshop.session_time','app_workshop.session_status', 'app_trainer.name as trainername')
            ->get();
		//dd($orders);
		$data['orders'] = $orders;
		return view('front.pages.course-order-list',$data);
	}
	
	public function profileUpdate(Request $request){
		$user_id = Auth::user()->id;
		$this->validate($request,[
			 'name'=>'required',
			 'age' => ['required'],
			'phone_number' => ['required'],
			'school' => ['required', 'string'],
			'profession' => ['required', 'string'],
			'country' => ['required'],
			'state' => ['required', 'string'],
			'add1'=>'required',
			'zip'=>'required',
			'photo'=>'max:1024',
        ]);
		

		$filename = '';
		if($request->file('photo')){
            $file= $request->file('photo');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('profile'), $filename);
        }

		$old_photo = Auth::user()->photo;
		
		$file_name = ($filename)?$filename:$old_photo;
		
		DB::table('users')->where('id',$user_id)->update(
		[
			'photo'=>$file_name,
			'name'=>$request->name,
			'address'=>$request->add1,
			'dob'=>$request->dob,
			'pincode'=>$request->zip,
			'age'=>$request->age,
			'school'=>$request->school,
			'profession'=>$request->profession,
			'country'=>$request->country,
			'state'=>$request->state,
			'reference'=>$request->reference,
			'phone_number'=>$request->phone_number,
		]);
		
		session()->flash('success', 'Profile updated Successfully !');
        return redirect()->route('dashboard');
		
	}
	
	public function saveWishList(Request $request,$slug){
		$pid = DB::table('app_product')->where('slug',$slug)->first();
		$check_wishlist = DB::table('app_wishlist')->where('user_id',Auth::user()->id)->where('product_id',$pid->id)->count();
		if($check_wishlist >0){
			session()->flash('error', 'Product already present in your wishlist !');
			return redirect()->route('wishlist');
		}
		DB::table('app_wishlist')->insert(['product_id'=>$pid->id,'user_id'=>Auth::user()->id]);
		session()->flash('success', 'Product added to your wishlist !');
        return redirect()->route('wishlist');
	}
	
	public function wishlist(){
		$data = array();
		$data['menu1'] = '';
		$data['menu2'] = '';
		$data['menu3'] = '';
		$data['menu4'] = 'active';
		$data['menu5'] = '';
		$data['menu6'] = '';
		$data['menu7'] = '';
		$data['wishlist'] = DB::table('app_wishlist')->join('app_product','app_wishlist.product_id','=','app_product.id')->where('user_id',Auth::user()->id)->get();
		return view('front.pages.wishlist',$data);
	}
	
	public function printInvoice($orderno){
		$data['orders'] = DB::table('app_order_item')->where('order_no',$orderno)->where('user_id',Auth::user()->id)->first();
		$data['address'] = DB::table('app_address')->where('order_id',$data['orders']->id)->where('user_id',Auth::user()->id)->orderBy('id','desc')->first();
		//dd($data['orders']);
		return view('front.pages.invoice',$data);
	}
	
	public function printInvoiceCourse($orderno){
		$data['orders'] = DB::table('app_order_item')->where('order_no',$orderno)->where('user_id',Auth::user()->id)->first();
		$data['address'] = DB::table('app_address')->where('order_id',$data['orders']->id)->where('user_id',Auth::user()->id)->orderBy('id','desc')->first();
		//dd($data['orders']);
		return view('front.pages.course-invoice',$data);
	}
	
	public function paymentStatus(){
		$get_all_payment = DB::table('app_payment_info')->where('payment_status','<>','Completed')->get();
		foreach($get_all_payment as $k=>$v){
			
		}
	}
}

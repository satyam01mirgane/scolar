<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HomeModel;
use DB;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use View;
use Session;
use Redirect;
use Auth;
use Razorpay\Api\Api;

class HomePageController extends Controller
{
    //
	public function showCareerPage()
    {
        return view('front.pages.career');
    }
	public function index(){
		$data=array();
		$data['home']='active';
		$data['about']='';
		$data['workshop']='';
		$data['course']='';
		$data['services']='';
		$data['blog']='';
		$data['events']='';
		$data['contact']='';
		
		$data['page_title'] = 'Home - '.app_setting()->site_title;
	    $data['testimonials'] = DB::table('app_testimonial')->get();
	    $data['blog_list'] = DB::table('app_blog')->orderBy('id','desc')->limit(3)->get();
	    $data['workshop_list'] = DB::table('app_workshop')->leftJoin('app_trainer', 'app_workshop.trainer_id', '=', 'app_trainer.id')->select('app_workshop.*','app_trainer.name as trainer_name','app_trainer.image as trainer_image')->where('content_type','=','Workshop')->where('session_status','=','Open')->orderBy('app_workshop.id','desc')->limit(6)->get();
	    $data['course_list'] = DB::table('app_workshop')->leftJoin('app_trainer', 'app_workshop.trainer_id', '=', 'app_trainer.id')->select('app_workshop.*','app_trainer.name as trainer_name','app_trainer.image as trainer_image')->where('content_type','!=','Workshop')->where('session_status','=','Open')->orderBy('app_workshop.id','desc')->limit(6)->get();
	    //dd($data['workshop_list']);
		return view('front.pages.home', $data);
	}
	
	public function about_us(){
		$data=array();
		$data['home']='';
		$data['about']='active';
		$data['workshop']='';
		$data['course']='';
		$data['services']='';
		$data['blog']='';
		$data['events']='';
		$data['contact']='';
		
		$data['page_title'] = 'About Us - '.app_setting()->site_title;
		
		return view('front.pages.about-us', $data);
	}
	
	
	public function sendEnquiry(Request $request){
		$to = "enquiry@ VSCHOLAR .in";
		$from = $request->email;
		$name = $request->name;
		$subject = "New Query";
		$number = $request->number;
		$cmessage = $request->message;

		$headers = "From: $from";
		$headers = "From: " . $from . "\r\n";
		$headers .= "Reply-To: ". $from . "\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

		$subject = "You have a message from ".$name;

		$logo = 'https:// VSCHOLAR .in/uploads/1/2022-09/logo.svg';
		$link = 'https:// VSCHOLAR .in/';

		$body = "<!DOCTYPE html><html lang='en'><head><meta charset='UTF-8'><title>Express Mail</title></head><body>";
		$body .= "<table style='width: 100%;'>";
		$body .= "<thead style='text-align: center;'><tr><td style='border:none;' colspan='2'>";
		$body .= "<a href='{$link}'><img src='{$logo}' alt='' width='150'></a><br><br>";
		$body .= "</td></tr></thead><tbody><tr>";
		$body .= "<td style='border:none;'><strong>Name:</strong> {$name}</td>";
		$body .= "<td style='border:none;'><strong>Email:</strong> {$from}</td>";
		$body .= "</tr>";
		$body .= "<tr><td style='border:none;'><strong>Subject:</strong> {$subject}</td></tr>";
		$body .= "<tr><td></td></tr>";
		$body .= "<tr><td colspan='2' style='border:none;'><strong>Message:</strong>{$cmessage}</td></tr>";
		$body .= "</tbody></table>";
		$body .= "</body></html>";

		$success = mail($to, $subject, $body, $headers);
		if ($success===true) {
				session()->flash('success', 'Query submitted successfully !');
				return redirect()->back();
		} else {
				session()->flash('error', "Oops! Something went wrong, we couldn't send your message.");
				return redirect()->back();
		}
	}
// Example in HomeController.php


	public function workshops(Request $request){
		$data=array();
		$data['home']='';
		$data['about']='';
		$data['workshop']='active';
		$data['course']='';
		$data['services']='';
		$data['blog']='';
		$data['events']='';
		$data['contact']='';
		
		$data['page_title'] = 'Workshops - '.app_setting()->site_title;
	    $name ='';
	     if(isset($request->search)){
	         $name = $request->search;
	         $data['workshop_list'] = DB::table('app_workshop')->leftJoin('app_trainer', 'app_workshop.trainer_id', '=', 'app_trainer.id')->select('app_workshop.*','app_trainer.name as trainer_name','app_trainer.image as trainer_image')->where('content_type','=','Workshop')->where('session_status','=','Open')->where('app_workshop.name','LIKE', "%$name%")->orderBy('app_workshop.id','desc')->get();
	     }else{
	         $data['workshop_list'] = DB::table('app_workshop')->leftJoin('app_trainer', 'app_workshop.trainer_id', '=', 'app_trainer.id')->select('app_workshop.*','app_trainer.name as trainer_name','app_trainer.image as trainer_image')->where('content_type','=','Workshop')->where('session_status','=','Open')->orderBy('app_workshop.id','desc')->get();
	     }
		 $data['search'] = $name;
		 //dd($data['search']);
		return view('front.pages.workshop-list', $data);
	}
	
	public function listQuiz(Request $request){
		if(!isset(Auth::user()->id)){
			session()->flash('error', 'Please login start quiz !');
			return redirect()->route('login');
		}
		$data=array();
		$data['home']='';
		$data['about']='';
		$data['workshop']='';
		$data['course']='active';
		$data['services']='';
		$data['blog']='';
		$data['events']='';
		$data['contact']='';
		
		$data['page_title'] = 'Quiz - '.app_setting()->site_title;
	    $data['start_quiz'] = DB::table('app_quiz_category')->orderBy('id','desc')->get();
		 //dd($data['search']);
		return view('front.pages.quiz-list', $data);
	}
	
	public function startQuiz(Request $request,$slug){
		if(!isset(Auth::user()->id)){
			session()->flash('error', 'Please login start quiz !');
			return redirect()->route('login');
		}
		$data=array();
		$data['home']='';
		$data['about']='';
		$data['workshop']='';
		$data['course']='active';
		$data['services']='';
		$data['blog']='';
		$data['events']='';
		$data['contact']='';
		
	    $data['quiz_cat'] = DB::table('app_quiz_category')->where('slug',$slug)->first();
		$data['page_title'] = $data['quiz_cat']->name.' Quiz - '.app_setting()->site_title;
		$data['quiz_list'] = DB::table('app_quiz_question')->where('quiz_category',$data['quiz_cat']->id)->get();
		return view('front.pages.start-quiz', $data);
	}
	
	public function submitQuiz(Request $request){
		if(!isset(Auth::user()->id)){
			session()->flash('error', 'Please login start quiz !');
			return redirect()->route('login');
		}
		$quiz_list = DB::table('app_quiz_question')->where('quiz_category',$request->quiz_id)->get();
		$answer_arr = [];
		foreach($quiz_list as $k=>$v){
			$ques = 'que'.++$k;
			$answer_arr[] = $request->$ques;
		}
		//dd($answer_arr);
		$correct_answer = 0;
		$correct_answer_id = [];
		foreach($quiz_list as $k=>$v){
			$quiz_list[$k]->quizres = $answer_arr[$k];
		}
		$data['answer'] = $correct_answer_id;
		$data['correct_answer'] = $correct_answer;
		$data['quiz_cat'] = DB::table('app_quiz_category')->where('id',$request->quiz_id)->first();
		$data['quiz_list'] = $quiz_list;
		
		if($_SERVER['REMOTE_ADDR']=='2409:4063:4d91:7539:880:a181:f3a7:2272'){
			//dd($data);
		}
		//dd($data);
		return view('front.pages.quiz-result', $data);
	}
	
	public function listTest(Request $request){
		if(!isset(Auth::user()->id)){
			session()->flash('error', 'Please login start test !');
			return redirect()->route('login');
		}
		$data=array();
		$data['home']='';
		$data['about']='';
		$data['workshop']='';
		$data['course']='active';
		$data['services']='';
		$data['blog']='';
		$data['events']='';
		$data['contact']='';
		
		$data['page_title'] = 'Online Test - '.app_setting()->site_title;
	    $data['start_quiz'] = DB::table('app_test_category')->orderBy('id','desc')->get();
		 //dd($data['search']);
		return view('front.pages.test-list', $data);
	}
	
	public function startTest(Request $request,$slug){
		if(!isset(Auth::user()->id)){
			session()->flash('error', 'Please login start test !');
			return redirect()->route('login');
		}
		$data=array();
		$data['home']='';
		$data['about']='';
		$data['workshop']='';
		$data['course']='active';
		$data['services']='';
		$data['blog']='';
		$data['events']='';
		$data['contact']='';
		
	    $data['quiz_cat'] = DB::table('app_test_category')->where('slug',$slug)->first();
		$data['page_title'] = $data['quiz_cat']->name.' Quiz - '.app_setting()->site_title;
		$data['quiz_list'] = DB::table('app_test_question')->where('quiz_category',$data['quiz_cat']->id)->get();
		return view('front.pages.start-test', $data);
	}
	
	public function submitTest(Request $request){
		if(!isset(Auth::user()->id)){
			session()->flash('error', 'Please login start test !');
			return redirect()->route('login');
		}
		$quiz_list = DB::table('app_test_question')->where('quiz_category',$request->quiz_id)->get();
		$answer_arr = [];
		foreach($quiz_list as $k=>$v){
			$ques = 'que'.++$k;
			$answer_arr[] = $request->$ques;
		}
		$correct_answer = 0;
		$correct_answer_id = [];
		foreach($quiz_list as $k=>$v){
			foreach($answer_arr as $j=>$l){
				if($v->answer==$l){
					$correct_answer++;
				}
				$correct_answer_id[$v->id] = $v->answer;
			}
		}
		$data['answer'] = $correct_answer_id;
		$data['correct_answer'] = $correct_answer;
		$data['quiz_cat'] = DB::table('app_test_category')->where('id',$request->quiz_id)->first();
		$data['quiz_list'] = $quiz_list;
		//dd($data);
		return view('front.pages.test-result', $data);
	}
	
	
	public function courses(Request $request){
		$data=array();
		$data['home']='';
		$data['about']='';
		$data['workshop']='';
		$data['course']='active';
		$data['services']='';
		$data['blog']='';
		$data['events']='';
		$data['contact']='';
		
		$data['page_title'] = 'Courses - '.app_setting()->site_title;
	    $course_type ='';
	    $class ='';
	    $skill ='';
		
		
		$course_data = DB::table('app_workshop')->leftJoin('app_trainer', 'app_workshop.trainer_id', '=', 'app_trainer.id')->select('app_workshop.*','app_trainer.name as trainer_name','app_trainer.image as trainer_image')->where('content_type','!=','Workshop');
		if(isset($request->course_type)){
			$course_type = $request->course_type;
			$course_data = $course_data->where('app_workshop.course_type','LIKE', "%$course_type%");
		}
		
		if(isset($request->classes)){
			$class = $request->classes;
			$course_data = $course_data->where('app_workshop.class_name','LIKE', "%$class%");
		}
		
		if(isset($request->skill)){
			$skill = $request->skill;
			$course_data = $course_data->where('app_workshop.skill_set','LIKE', "%$skill%");
		}
		
		
		$course_data = $course_data->where('app_workshop.name','LIKE', "%$name%")->orderBy('app_workshop.id','desc')->paginate(10);
	     if(isset($request->search)){
	         $name = $request->search;
	         $data['course_list'] = DB::table('app_workshop')->leftJoin('app_trainer', 'app_workshop.trainer_id', '=', 'app_trainer.id')->select('app_workshop.*','app_trainer.name as trainer_name','app_trainer.image as trainer_image')->where('content_type','!=','Workshop')->where('app_workshop.name','LIKE', "%$name%")->orderBy('app_workshop.id','desc')->paginate(10);
	     }else{
	         $data['course_list'] = DB::table('app_workshop')->leftJoin('app_trainer', 'app_workshop.trainer_id', '=', 'app_trainer.id')->select('app_workshop.*','app_trainer.name as trainer_name','app_trainer.image as trainer_image')->where('content_type','!=','Workshop')->orderBy('app_workshop.id','desc')->paginate(10);
	     }
		 
		 $data['course_list'] = $course_data;
		 
		 $data['course_type'] = $course_type;
		 $data['search'] = $name;
		 $data['class'] = $class;
		 $data['skill'] = $skill;
		 //dd($data['search']);
		return view('front.pages.course-list', $data);
	}
	
	public function workshopDetail(Request $request,$slug){
		$data=array();
		$data['home']='';
		$data['about']='';
		$data['workshop']='active';
		$data['course']='';
		$data['services']='';
		$data['blog']='';
		$data['events']='';
		$data['contact']='';
		
		$data['page_title'] = 'Workshops - '.app_setting()->site_title;
		$data['testimonials'] = DB::table('app_testimonial')->get();
		$data['workshop_details'] = DB::table('app_workshop')->leftJoin('app_trainer', 'app_workshop.trainer_id', '=', 'app_trainer.id')->select('app_workshop.*','app_trainer.name as trainer_name','app_trainer.image as trainer_image','app_trainer.designation as designation','app_trainer.description as description')->where('content_type','=','Workshop')->where('app_workshop.slug',$slug)->first();
		//dd($data['workshop_details']);
		return view('front.pages.workshop-details', $data);
	}
	public function courseDetail(Request $request,$slug){
		$data=array();
		$data['home']='';
		$data['about']='';
		$data['workshop']='';
		$data['course']='active';
		$data['services']='';
		$data['blog']='';
		$data['events']='';
		$data['contact']='';
		
		$data['page_title'] = 'Workshops - '.app_setting()->site_title;
		$data['testimonials'] = DB::table('app_testimonial')->get();
		$data['course_details'] = DB::table('app_workshop')->leftJoin('app_trainer', 'app_workshop.trainer_id', '=', 'app_trainer.id')->select('app_workshop.*','app_trainer.name as trainer_name','app_trainer.image as trainer_image','app_trainer.designation as designation','app_trainer.description as description')->where('content_type','!=','Workshop')->where('app_workshop.slug',$slug)->first();
		//echo "<pre>";print_r($data['course_details']);die;
		return view('front.pages.course-details', $data);
	}
	
	
	public function commentAdd(Request $request){
		$ins=DB::table('app_comment')->insert(['blog_id'=>$request->bid,'name'=>$request->form_name,'email'=>$request->form_email,'review'=>$request->form_message]);
		session()->flash('success', 'Item Cart is Updated Successfully !');
		return redirect()->back();
	}
	
	public function querySubmit(Request $request){
		$ins=DB::table('app_query')->insert(['name'=>$request->name,'email'=>$request->email,'phone'=>$request->phone,
											'query_date'=>$request->date,'query_type'=>$request->subject,'message'=>$request->message]);
		session()->flash('success', 'Query submitted successfully !');
		return redirect()->back();
	}
	
	public function services(){
		$data=array();
		$data['home']='';
		$data['about']='';
		$data['workshop']='';
		$data['services']='active';
		$data['blog']='';
		$data['events']='';
		$data['contact']='';
		
		$data['page_title'] = 'Services - '.app_setting()->site_title;
		$data['service_list'] = DB::table('app_services')->get();
		
		return view('front.pages.services', $data);
	}
	
	public function blogs(Request $request){
		$data=array();
		$data['home']='';
		$data['about']='';
		$data['workshop']='';
		$data['services']='';
		$data['course']='';
		$data['blog']='active';
		$data['events']='';
		$data['contact']='';
		$data['blog_page'] = 'main';
		
		$data['page_title'] = 'blogs - '.app_setting()->site_title;
		$data['category'] = DB::table('app_category')->get();
		$name = $request->blogsearch;
		if(isset($request->blogsearch)){
		    $name = $request->blogsearch;
		    $data['blog_list'] = DB::table('app_blog')->where('name','LIKE', "%$name%")->orderBy('id','DESC')->paginate(10);
		}else{
		    $data['blog_list'] = DB::table('app_blog')->orderBy('id','DESC')->paginate(10);
		}
		$data['searchname'] = $name;
		return view('front.pages.blogs', $data);
	}
	public function blogList(Request $request,$name){
		$data=array();
		$data['home']='';
		$data['about']='';
		$data['workshop']='';
		$data['services']='';
		$data['blog']='active';
		$data['course']='';
		$data['events']='';
		$data['contact']='';
		$data['blog_page'] = 'cat';
		
		$data['page_title'] = 'blogs - '.app_setting()->site_title;
		$data['category_details'] = DB::table('app_category')->where('slug',$name)->first();
		$data['category'] = DB::table('app_category')->get();
		$name = $request->blogsearch;
		if(isset($request->blogsearch)){
		    $data['blog_list'] = DB::table('app_blog')->where('category_id',$data['category_details']->id)->where('name','LIKE', "%$name%")->orderBy('id','DESC')->paginate(10);
		}else{
		    $data['blog_list'] = DB::table('app_blog')->where('category_id',$data['category_details']->id)->orderBy('id','DESC')->paginate(10);
		}
		$data['searchname'] = $name;
		return view('front.pages.blogs', $data);
	}
	
	public function blogDetail($name){
		$data=array();
		$data['home']='';
		$data['about']='';
		$data['workshop']='';
		$data['services']='';
		$data['blog']='active';
		$data['course']='';
		$data['events']='';
		$data['contact']='';
		
		$data['page_title'] = 'blogs - '.app_setting()->site_title;
		$data['category'] = DB::table('app_category')->get();
		$data['blog_detail'] = DB::table('app_blog')->where('slug',$name)->first();
		$data['category_details'] = DB::table('app_category')->where('id',$data['blog_detail']->category_id)->first();
		$data['comment'] = DB::table('app_comment')->where('blog_id',$data['blog_detail']->id)->where('status','Active')->get();
		$data['blog_list'] = DB::table('app_blog')->where('id','<>',$data['blog_detail']->id)->orderBy('id','DESC')->paginate(10);
		$bg_id = $data['blog_detail']->id;
		$data['blog_detail_next'] = DB::table('app_blog')->where('id','>',$bg_id)->orderBy('id')->first();
		$data['blog_detail_prev'] = DB::table('app_blog')->where('id','<',$bg_id)->orderBy('id','desc')->first();
		
		return view('front.pages.blog-detail', $data);
	}
	
	
	
	public function events(){
		$data=array();
		$data['home']='';
		$data['about']='';
		$data['workshop']='';
		$data['services']='';
		$data['blog']='';
		$data['events']='active';
		$data['course']='';
		$data['contact']='';
		
		$data['page_title'] = 'Events - '.app_setting()->site_title;
		
		$data['current_data'] = DB::table('app_events')->where('end_date','>=',date('Y-m-d'))->get();
		$data['old_data'] = DB::table('app_events')->where('end_date','<',date('Y-m-d'))->get();
		//dd($data['old_data']);
		
		return view('front.pages.events', $data);
	}
	
	public function contact_us(){
		$data=array();
		$data['home']='';
		$data['about']='';
		$data['workshop']='';
		$data['services']='';
		$data['course']='';
		$data['blog']='';
		$data['events']='';
		$data['contact']='active';
		
		$data['page_title'] = 'Contact Us - '.app_setting()->site_title;

		return view('front.pages.contact-us', $data);
	}
	
	
	public function saveNewsletter(Request $request){
	    $check_email = DB::table('app_newsletter')->where('email',$request->em)->first();
	    if(!is_null($check_email)){
	        echo json_encode(array("status"=>"exist"));die;
	    }
	    $saveEmail = DB::table('app_newsletter')->insert(['email'=>$request->em]);
	    if($saveEmail){
	        echo json_encode(array("status"=>"success"));die;
	    }else{
	        echo json_encode(array("status"=>"fail"));die;
	    }
	}
	
	public function savePopupData(Request $request){
	   $to = "enquiry@ VSCHOLAR .in";
		$from = $request->email;
		$name = $request->name;
		$subject = "New Query";
		$number = $request->contact;

		$headers = "From: $from";
		$headers = "From: " . $from . "\r\n";
		$headers .= "Reply-To: ". $from . "\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

		$subject = "You have a message from ".$name;

		$logo = 'https:// VSCHOLAR .in/uploads/1/2022-09/logo.svg';
		$link = 'https:// VSCHOLAR .in/';

		$body = "<!DOCTYPE html><html lang='en'><head><meta charset='UTF-8'><title>Express Mail</title></head><body>";
		$body .= "<table style='width: 100%;'>";
		$body .= "<thead style='text-align: center;'><tr><td style='border:none;' colspan='2'>";
		$body .= "<a href='{$link}'><img src='{$logo}' alt='' width='150'></a><br><br>";
		$body .= "</td></tr></thead><tbody><tr>";
		$body .= "<td style='border:none;'><strong>Name:</strong> {$name}</td>";
		$body .= "<td style='border:none;'><strong>Email:</strong> {$from}</td>";
		$body .= "</tr>";
		$body .= "<tr><td style='border:none;'><strong>Contact No:</strong> {$number}</td></tr>";
		$body .= "<tr><td></td></tr>";
		$body .= "</tbody></table>";
		$body .= "</body></html>";

		$success = mail($to, $subject, $body, $headers);
		
		DB::table('app_blocker_data')->insert(['name'=>$name,'email'=>$from,'number'=>$number]);
		
	    if($success){
	        echo json_encode(array("status"=>"success"));die;
	    }else{
	        echo json_encode(array("status"=>"fail"));die;
	    }
	}
	

	public function login(Request $request){
		$data=array();
		return view('front.pages.login', $data);
	}
	
	public function getState(Request $request){
		$state = DB::table('tbl_states')->where('country_id',$request->cid)->orderBy('name','asc')->get()->toArray();
		return response()->json(array('state'=> $state), 200);
	}
	public function getCities(Request $request){
		$state = DB::table('tbl_cities')->where('state_id',$request->sid)->orderBy('name','asc')->get()->toArray();
		return response()->json(array('city'=> $state), 200);
	}
	
	public function category($slug){
		$data=array();
		$catdata = DB::table('app_category')->where('slug',$slug)->first();
		//dd($catdata);
		$data['products'] = DB::table('app_product')->where('category',$catdata->id)->orderBy('id','desc')->paginate(9);
		$data['catdata'] = $catdata;
		return view('front.pages.product-list', $data);
	}
	
	public function faq(){
		$data=array();
		$data['about']='';
		$data['home']='';
		$data['classs']='';
		$data['contact']='';
		$data['blog']='';
		$data['faqp']='active';
		//$data['faq'] = DB::table('app_faq')->get();
		$data['testimonials'] = DB::table('app_testimonials')->get();
		$data['faq'] = DB::table('app_faq')->get();
		return view('front.pages.faq', $data);
	}
	public function other(){
		$data=array();
		//$data['faq'] = DB::table('app_other')->get();
		$data['testimonials'] = DB::table('app_testimonials')->get();
		return view('front.pages.other', $data);
	}
	
	
	public function page(Request $request, $name){
		$data = array();
		$data['menu_details'] = DB::table('app_menu')->where('slug',$name)->first();
		$data['page_details'] = DB::table('app_pages')->where('menu_id',$data['menu_details']->id)->first();
		return view('front.pages.page-details', $data);
	}
	
	public function paymentStatus(){
		$get_all_payment = DB::table('app_payment_info')->where('rz_order_id','<>','')->get();
		//dd($get_all_payment);
		 $api = new Api('rzp_test_vPpKZ6HJO3H88P','BRq2br6TnuxyikKjmn7DQUVn');
		foreach($get_all_payment as $k=>$v){
			$data = $api->order->fetch($v->rz_order_id)->payments();
			//dd($data);
		}
	}
	
	public function sendReminderEmail(){
		//$get_all_data = DB::select("select * from app_workshop where session_date > now() + interval 1 month ");
		$get_all_data = DB::select("select api.order_id,api.payment_status, aw.session_date,aw.session_date from app_payment_info as api join app_workshop as aw on api.order_id=aw.id");
		dd($get_all_data);
		
	}
}

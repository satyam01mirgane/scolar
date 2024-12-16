<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
	public function showCareerPage()
{
    return view('career'); // Make sure 'career.blade.php' exists in the resources/views directory.
}

    public function index()
    {
		$data = array();
		$course_id = DB::table('student_course')->where('student_id',Auth::user()->id)->where('status','Credit')->pluck('course_id')->toArray();
		
		$course_details = [];
		if(count($course_id)>0){
			$course_details = DB::table('app_course')->whereIn('id',$course_id)->get();
		}
		$data['course_id'] = $course_id;
		$data['course_details'] = $course_details;
        return view('home',$data);
    }
	public function courseDetails(Request $request, $name, $id){
		$data = array();
		$id = base64_decode($id);
		$data['course_details'] = DB::table('app_course')->where('id',$id)->first();
		$data['category_name'] = GetCatNameById($data['course_details']->category);
		$data['total_student_in_course'] = DB::table('student_course')->where('course_id',$data['course_details']->id)->count();
		$data['instructer'] = DB::table('app_trainer')->where('id',$data['course_details']->instructor)->first();
		$data['app_category'] = DB::table('app_category_function')->get();
		$data['course'] = DB::table('app_course')->where('category',$data['course_details']->category)->where('id','<>',$id)->paginate(30);
		//dd($data['course_details']);
		return view('front.pages.course-content', $data);
	}
}

<?php
use Illuminate\Support\Facades\DB;

if(!function_exists('app_setting')) {
	function app_setting(){
		$app_setting = DB::table('app_setting')->first();
		//dd($home_page_settings);
		return $app_setting;
	}
}
if(!function_exists('common_settings')) {
	function common_settings(){
		$common_settings = DB::table('app_common_heading_content')->first();
		//dd($home_page_settings);
		return $common_settings;
	}
}

if(!function_exists('calculate_discount')) {
	function calculate_discount($id){
		$calculate_discount = DB::table('app_workshop')->where('id',$id)->first();
		//dd($calculate_discount);
		$discount = 0;
		if(isset($calculate_discount)){
			$discount = $calculate_discount->discount_value;
		}
		//dd($home_page_settings);
		return $discount;
	}
}

if(!function_exists('cartproduct')) {
	function cartproduct(){
		$cartItems = \Cart::getContent();
		$cartArr = [];
		foreach($cartItems as $k=>$v){
			$cartArr[] = $v->id;
		}
		return $cartArr;
	}
}

if(!function_exists('category_list')) {
	function category_list($limit=null){
		if($limit){
			$category_list = DB::table('app_category')->limit($limit)->get();
		}else{
			$category_list = DB::table('app_category')->get();
		}
		return $category_list;
	}
}

if(!function_exists('workshop_list')) {
	function workshop_list(){
		$workshop_list = DB::table('app_workshop')->where('session_status','=','Open')->orderBy('id','desc')->limit(3)->get();
		return $workshop_list;
	}
}
if(!function_exists('menu_list')) {
	function menu_list(){
		$menu_list = DB::table('app_menu')->get();
		return $menu_list;
	}
}

if(!function_exists('country_list')) {
	function country_list(){
		$country_list = DB::table('tbl_countries')->get();
		return $country_list;
	}
}
if(!function_exists('service_list')) {
	function service_list(){
		$service_list = DB::table('app_services')->orderBy('id','ASC')->get();
		return $service_list;
	}
}
if(!function_exists('faq_list')) {
	function faq_list(){
		$faq_list = DB::table('app_faq')->orderBy('id','DESC')->get();
		return $faq_list;
	}
}

if(!function_exists('GetCatNameById')) {
	function GetCatNameById($cat_id){
		$category_val = DB::table('app_workshop')->leftJoin('app_trainer', 'app_workshop.trainer_id', '=', 'app_trainer.id')->select('app_trainer.name as trainer_name')->where('app_workshop.id',$cat_id)->first();
		return $category_val;
	}
}
if(!function_exists('GetParentCatNameById')) {
	function GetParentCatNameById($cat_id){
		$category_val = DB::table('app_menu')->where('id',$cat_id)->first();
		return $category_val;
	}
}
if(!function_exists('getCategoryList')) {
	function getCategoryList(){
		$category_val = DB::table('app_category')->get();
		return $category_val;
	}
}
if(!function_exists('cleanString')) {
	function cleanString($string){
		$string = str_replace(' ', '-', strtolower($string)); // Replaces all spaces with hyphens.
		return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
	}
}
if(!function_exists('truncate')) {
	function truncate($string,$length=50,$append="...") {
	$string = trim($string);

	if(strlen($string) > $length) {
		$string = wordwrap($string, $length);
		$string = explode("\n", $string, 2);
		$string = $string[0] . $append;
	}

	  return $string;
	}
}
if(!function_exists('GetCountryNameById')) {
	function GetCountryNameById($cat_id){
		$category_val = DB::table('tbl_countries')->where('id',$cat_id)->first()->name;
		return $category_val;
	}
}
if(!function_exists('GetblogCountById')) {
	function GetblogCountById($cat_id){
		$category_val = DB::table('app_blog')->where('category_id',$cat_id)->count();
		return $category_val;
	}
}
if(!function_exists('GetStateNameById')) {
	function GetStateNameById($cat_id){
		$category_val = DB::table('tbl_states')->where('id',$cat_id)->first()->name;
		return $category_val;
	}
}
if(!function_exists('GetCityNameById')) {
	function GetCityNameById($cat_id){
		$category_val = DB::table('tbl_cities')->where('id',$cat_id)->first()->name;
		return $category_val;
	}
}
if(!function_exists('getOrder')) {
	function getOrder(){
	    $orderno = 'ORD00000184';
		$orders = DB::table('app_order_item')->where('order_no',$orderno)->where('user_id',Auth::user()->id)->get()->toArray();
		return $orders;
	}
}
if(!function_exists('numberTowords')) {
	function numberTowords($num)
    {
    	$ones = array(
    	0 =>"ZERO",
    	1 => "ONE",
    	2 => "TWO",
    	3 => "THREE",
    	4 => "FOUR",
    	5 => "FIVE",
    	6 => "SIX",
    	7 => "SEVEN",
    	8 => "EIGHT",
    	9 => "NINE",
    	10 => "TEN",
    	11 => "ELEVEN",
    	12 => "TWELVE",
    	13 => "THIRTEEN",
    	14 => "FOURTEEN",
    	15 => "FIFTEEN",
    	16 => "SIXTEEN",
    	17 => "SEVENTEEN",
    	18 => "EIGHTEEN",
    	19 => "NINETEEN",
    	"014" => "FOURTEEN"
    	);
    	$tens = array( 
    	0 => "ZERO",
    	1 => "TEN",
    	2 => "TWENTY",
    	3 => "THIRTY", 
    	4 => "FORTY", 
    	5 => "FIFTY", 
    	6 => "SIXTY", 
    	7 => "SEVENTY", 
    	8 => "EIGHTY", 
    	9 => "NINETY" 
    	); 
    	$hundreds = array( 
    	"HUNDRED", 
    	"THOUSAND", 
    	"MILLION", 
    	"BILLION", 
    	"TRILLION", 
    	"QUARDRILLION" 
    	); /*limit t quadrillion */
    	$num = number_format($num,2,".",","); 
    	$num_arr = explode(".",$num); 
    	$wholenum = $num_arr[0]; 
    	$decnum = $num_arr[1]; 
    	$whole_arr = array_reverse(explode(",",$wholenum)); 
    	krsort($whole_arr,1); 
    	$rettxt = ""; 
    			foreach($whole_arr as $key => $i){
    				while(substr($i,0,1)=="0")
    				$i=substr($i,1,5);
    					if($i < 20){ 
    					/* echo "getting:".$i; */
    					$rettxt .= $ones[$i]; 
    				}elseif($i < 100){ 
    					if(substr($i,0,1)!="0")  $rettxt .= $tens[substr($i,0,1)]; 
    					if(substr($i,1,1)!="0") $rettxt .= " ".$ones[substr($i,1,1)]; 
    				}else{ 
    					if(substr($i,0,1)!="0") $rettxt .= $ones[substr($i,0,1)]." ".$hundreds[0]; 
    					if(substr($i,1,1)!="0")$rettxt .= " ".$tens[substr($i,1,1)]; 
    					if(substr($i,2,1)!="0")$rettxt .= " ".$ones[substr($i,2,1)]; 
    				} 
    				if($key > 0){ 
    					$rettxt .= " ".$hundreds[$key]." "; 
    				}
    			} 
    			if($decnum > 0){
    					$rettxt .= " and ";
    				if($decnum < 20){
    					$rettxt .= $ones[$decnum];
    				}elseif($decnum < 100){
    					$rettxt .= $tens[substr($decnum,0,1)];
    					$rettxt .= " ".$ones[substr($decnum,1,1)];
    				}
    			}
    			
    			return $rettxt;
    }
}


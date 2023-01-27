<?php

namespace App\Utils;

class Helper {
	public static function toKnumber($text){
		return str_replace(array("0","1","2","3","4","5","6","7","8","9"),array("០","១","២","៣","៤","៥","៦","៧","៨","៩"),$text);
	}
	public static function toLnumber($text){
		return str_replace(array("០","១","២","៣","៤","៥","៦","៧","៨","៩"),array("0","1","2","3","4","5","6","7","8","9"),$text);
	}
	public static function toKmonth($month='01'){
		$months = array("01"=>"មករា","02"=>"កុម្ភៈ","03"=>"មីនា","04"=>"មេសា","05"=>"ឧសភា","06"=>"មិថុនា","07"=>"កក្កដា","08"=>"សីហា","09"=>"កញ្ញា","10"=>"តុលា","11"=>"វិច្ឆិកា","12"=>"ធ្នូ");
		return $months[$month];
	}
	public static function toKday($day='Mon'){
		$days = array("Mon"=>"ច័ន្ទ","Tue"=>"អង្គារ៍","Wed"=>"ពុធ","Thu"=>"ព្រហស្បត៍","Fri"=>"សុក្រ","Sat"=>"សៅរ៍","Sun"=>"អាទិត្យ");
		return $days[$day];
	}
	// Y-m-d
	public static function toKdate($string_date){
		$months = array("01"=>"មករា","02"=>"កុម្ភៈ","03"=>"មីនា","04"=>"មេសា","05"=>"ឧសភា","06"=>"មិថុនា","07"=>"កក្កដា","08"=>"សីហា","09"=>"កញ្ញា","10"=>"តុលា","11"=>"វិច្ឆិកា","12"=>"ធ្នូ");
		list($year,$month,$day)=explode("-",\Carbon\Carbon::parse( $string_date )->format('Y-m-d') );
		$date = Helper::toKnumber($day) . " " . 
		$months[$month] . " ". 
		Helper::toKnumber($year);
		return $date ;
	}
	public static function toFloat( $numeric , $behindZero = 2 , $comma = false ){
		return $comma!==false ? number_format( $numeric , $behindZero , '.' , ',' ) : number_format( $numeric , $behindZero , '.' , '' ) ;
	}
	public static function fileGetContentsCurl($url)
	{
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_URL, $url);

		$data = curl_exec($ch);
		curl_close($ch);

		return $data;
	} 
	public static function urlExists($url){
		$array = get_headers($url);
		dd( $array );
		$string = $array[0];
		return strpos($string, "200")? true : false ;
	}
}

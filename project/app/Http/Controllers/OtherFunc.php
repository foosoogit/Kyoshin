<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class OtherFunc extends Controller
{
    public static function set_access_history($REFERER){
		//print isset($_SESSION['access_history']);
		if(isset($_SESSION['access_history'])){
			if(is_array($_SESSION['access_history'])){
				array_unshift($_SESSION['access_history'],$REFERER);
			}else{
				$_SESSION['access_history']=array();
				$_SESSION['access_history'][]=$REFERER;
			}
		}else{
			$_SESSION['access_history']=array();
			$_SESSION['access_history'][]=$REFERER;
		}
	}

	public static function get_student_new_serial(){
		$max_serial=Student::max('serial_student');
		$new_serial=$max_serial++;
		return $new_serial;
	}
}
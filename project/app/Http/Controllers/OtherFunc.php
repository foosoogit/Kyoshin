<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Http\Controllers\InitConsts;

class OtherFunc extends Controller
{
    public static function make_html_course_ckbox($target){
		//print "targetgrade=".$targetgrade;
		$target_CourceArray_array=InitConsts::CourceArray();
		$htm_cource_ckbox='';
		foreach($target_CourceArray_array as $cource){
			$cked='';
			//print "cource=".$cource."<br>";
			//mb_strstr($cource, $target)!== false;
			if(mb_strstr( $target,$cource)!== false){$cked='checked="checked"';}
			$htm_cource_ckbox.='<label class="block font-medium text-sm text-gray-700"><input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="checkbox" name="course[]" value="'.$cource.'" '.$cked.'>'.$cource.'<label>';
		}
        $htm_cource_ckbox.='</select>';
		return $htm_cource_ckbox;
	}

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

	public static function make_html_grade_slct($targetgrade){
		//print "targetgrade=".$targetgrade;
		$target_grade_array=InitConsts::GradeArray();
		$htm_grade_slct='<select id="grade" name="grade" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" required>';
		$htm_grade_slct.='<option value="" disabled selected style="display:none;"></option>';
		foreach($target_grade_array as $grade){
			$slctd='';
			//print "grade=".$grade."<br>";
			if($targetgrade==$grade){$slctd='Selected="selected"';}
			$htm_grade_slct.='<option value="'.$grade.'" '.$slctd.' >'.$grade.'</option>';
		}
        $htm_grade_slct.='</select>';
		return $htm_grade_slct;
	}
}
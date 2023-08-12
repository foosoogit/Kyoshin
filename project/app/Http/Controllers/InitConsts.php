<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Illuminate\Support\Facades\DB;
use App\Models\configration;


class InitConsts extends Controller
{
    public static function CourceArray(){
        $Tcource=configration::where('subject','=','Course')->first();
        $course_array=explode(",", $Tcource->value1);
        return $course_array;
    }

    public static function DdisplayLineNumStudentsList(){
        $inits_array=configration::where('subject','=','DdisplayLineNumStudentsList')->first();
        return $inits_array->value1;
    }

    public static function GradeArray(){
        $Tgrade=configration::where('subject','=','Grade')->first();
        $grade_array=explode(",", $Tgrade->value1);
        return $grade_array;
    }
}

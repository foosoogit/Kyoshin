<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Illuminate\Support\Facades\DB;
use App\Models\configration;


class InitConsts extends Controller
{
    public static function DdisplayLineNumStudentsList(){
        $inits_array=configration::where('subject','=','DdisplayLineNumStudentsList')->first();
        return $inits_array->value1;
    }

    public static function Grade(){
        $GradeArray=array();
        $GradeArray['el1']='小1';
        $GradeArray['el2']='小2';
        $GradeArray['el3']='小3';
        $GradeArray['el4']='小4';
        $GradeArray['el5']='小5';
        $GradeArray['el6']='小6';
        $GradeArray['jh1']='中1';
        $GradeArray['jh2']='中2';
        $GradeArray['jh3']='中3';
        $GradeArray['jh1']='中1';
        $GradeArray['hs1']='高1';
        $GradeArray['hs2']='高2';
        $GradeArray['hs3']='高3';
        return $GradeArray;
    }
}

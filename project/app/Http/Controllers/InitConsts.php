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
}

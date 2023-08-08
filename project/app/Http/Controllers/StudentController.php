<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Http\Controllers\InitConsts;
use App\Http\Controllers\OtherFunc;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreStudentRequest;

class StudentController extends Controller
{
    public function store(StoreStudentRequest $request)
    {
        /*
        $request->validate([
            'title' => 'required|string',
            'category' => 'required|integer|digits_between:1,2',
            'author' => 'nullable|string',
            'purchase_date' => 'nullable|date|before_or_equal:today',
            'evaluation' => 'nullable|integer|between:1,5',
            'memo' => 'nullable|string',
        ]);
        */
        //print "store";

        $request->validate([
            'email' => 'required|unique:users',
            //'name_sei' => 'required',
       ]);

      //print_r($request);

       /*
      $validator = Validator::make($request->all(), [
        'email' => 'required|unique:users,email',
        ]);
        */
             //print "validated=".$validator->fails();
        /*
        if ($validator->fails()) {
            //exit;
            return redirect('/usersregister')
                ->withInput()
                ->withErrors($validator);
            
        }else{
            return view('admin.menu');
        }
        */
        /*
        if ($validated_data->fails()) {
            /// バリデーション失敗時の処理...
            exit;
        }
        */
        Student::create($request->all());
        //return view('admin.menu');
        //return Redirect::route('books.index')->with('status', 'books-stored');
    }

    public function show_inp_store(Request $request)
    {
        $students_array=InitConsts::Grade();
        $student_serial=OtherFunc::get_student_new_serial();
        $student_serial++;
        return view('admin.CreateStudent',compact("student_serial","students_array"));
    }
}

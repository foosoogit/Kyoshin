<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Http\Controllers\InitConsts;
use App\Http\Controllers\OtherFunc;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreStudentRequest;
use App\Mail\ContactMail;
use App\Models\InOutHistory;

class StudentController extends Controller
{
    
    public function ShowRireki(){
        return view('admin.ListStudents',compact("target_key"));
	}

    public function SendInOutMail(Request $request)
    {
        $content = Student::where('serial_student','=',$request->StudentSerial)->first();
        $content = $request->input('content'); 
        //$user = auth()->user();
	
    	Mail::to($user->email)->send(new ContactMail($content));
	// メール送信後の処理
    }
    
    public function destroy($StudentID)
    {
        //Student::destroy($id);
        
        //delete from InOutHistory where student_serial in(select student_serial from students where StudentID='id')
        //print "StudentID=!".$StudentID;

        $InOutquery=inouthistory::whereIn("student_serial", function($query) use($StudentID){
            $query->from("students")
            ->select("serial_student")
            ->where("id", "=", $StudentID);
        })->delete();

       //dd($InOutquery->toSql(), $InOutquery->getBindings());
       Student::find($StudentID)->delete();
       /*
       $student = Student::find($StudentID);
        $student->update([
            //'serial_student'=>$request->serial_student,
            'email'=>"",
            'name_sei'=>"",
            'name_mei'=>"",
            'name_sei_kana'=>"",
            'name_mei_kana'=>"",
            'protector'=>"",
            'gender'=>"",
            'phone'=>"",
            'grade'=>"",
            'note'=>"",
            'course'=>"",
        ]);
        */
        return back();
    }

    public function ShowStudentModifyList($stud_seraial){
		session(['serchKey' =>$stud_seraial]);
        $target_key=$stud_seraial;
        return view('admin.ListStudents',compact("target_key"));
	}
    public function ShowInputStudent(Request $request){
		session(['fromPage' => 'InputStudent']);
		$stud_inf=Student::where('serial_student','=',$request->StudentSerial_Btn)->first();
        $html_grade_slct=OtherFunc::make_html_grade_slct($stud_inf->grade);
        $html_cource_ckbox=OtherFunc::make_html_course_ckbox($stud_inf->course);
        $student_serial=$stud_inf->serial_student;
        $mnge='modify';
        return view('admin.CreateStudent',compact("html_cource_ckbox","stud_inf","html_grade_slct","student_serial","mnge"));
	}
    
    public function store(StoreStudentRequest $request)
    {
        $course = implode( ",", $request->course );

        Student::create([
            'serial_student'=>$request->serial_student,
            'email'=>$request->email,
            'name_sei'=>$request->name_sei,
            'name_mei'=>$request->name_mei,
            'name_sei_kana'=>$request->name_sei_kana,
            'name_mei_kana'=>$request->name_mei_kana,
            'protector'=>$request->protector,
            'gender'=>$request->gender,
            'phone'=>$request->phone,
            'grade'=>$request->grade,
            'elementary'=>$request->elementary,
            'junior_high'=>$request->junior_high,
            'high_school'=>$request->high_school,
            'note'=>$request->note,
            'course'=>$course,
        ]);
        $msg="登録しました。";
        $mnge='create';
        return view('admin.menu_after_student_store',compact("msg","mnge"));
    }

    public function ShowInputNewStudent(Request $request)
    {
        $targetgrade="";
        $html_grade_slct=OtherFunc::make_html_grade_slct($targetgrade);
        $TargetCource="";
        $html_cource_ckbox=OtherFunc::make_html_course_ckbox($TargetCource);
        //$student_serial=OtherFunc::get_student_new_serial();
        
        //$student_serial++;
        //$stud_inf=Student::where('email','=',"0000")->first();
        $stud_inf=Student::whereNull('email')->orderby('id')->first();
        //$student_serial=$stud_inf;
        session(['StudentManage' => 'create']);
        $mnge='create';
        //return view('admin.CreateStudent',compact("html_cource_ckbox","stud_inf","student_serial","html_grade_slct","mnge"));
        return view('admin.CreateStudent',compact("html_cource_ckbox","stud_inf","html_grade_slct","mnge"));
    }

    public function edit(Student $Student)
    {
        session(['StudentManage' => 'modify']);
        return view('students.CreateStudent', ['Student' => $Student]);
    }
    
    public function update(Request $request, $id)
    {
        
        $course = implode( ",", $request->course );
        print "id=".$id;
        $student = Student::find($id);
        $student->update([
            //'serial_student'=>$request->serial_student,

            'email'=>$request->email,
            'name_sei'=>$request->name_sei,
            'name_mei'=>$request->name_mei,
            'name_sei_kana'=>$request->name_sei_kana,
            'name_mei_kana'=>$request->name_mei_kana,
            'protector'=>$request->protector,
            'gender'=>$request->gender,
            'phone'=>$request->phone,
            'grade'=>$request->grade,
            'elementary'=>$request->elementary,
            'junior_high'=>$request->junior_high,
            'high_school'=>$request->high_school,
            'note'=>$request->note,
            'course'=>$course,
        ]);

        $msg="修正しました。";
        $mnge='modify';
        $serial=$student->serial_student;
        return view('admin.menu_after_student_store',compact("msg","mnge","serial"));
    }
}
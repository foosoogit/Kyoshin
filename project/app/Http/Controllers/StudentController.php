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
        $email_array=explode(",", $stud_inf->email);
        for ($i=0;$i<3;$i++){
            if(!isset( $email_array[$i])){
                $email_array[$i]=""; 
            }
        }
        $protector_array=explode(",", $stud_inf->protector);
        for ($i=0;$i<3;$i++){
            if(!isset($protector_array[$i])){
                $protector_array[$i]=""; 
            }
        }
        //print_r($protector_array);
        $mnge='modify';
        return view('admin.CreateStudent',compact("protector_array","email_array","html_cource_ckbox","stud_inf","html_grade_slct","student_serial","mnge"));
	}
    
    public function store(StoreStudentRequest $request)
    {
        $course = implode( ",", $request->course );
        $protector = implode( ",", $request->protector_array );
        $email = implode( ",", $request->email_array );

        Student::create([
            'serial_student'=>$request->serial_student,
            'email'=>$email,
            'name_sei'=>$request->name_sei,
            'name_mei'=>$request->name_mei,
            'name_sei_kana'=>$request->name_sei_kana,
            'name_mei_kana'=>$request->name_mei_kana,
            'protector'=>$protector,
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
        $protector_array=array();$email_array=array();
        for($i=0;$i<=2;$i++){
            $protector_array[$i]="";
            $email_array[$i]="";
        }
        $stud_inf=Student::whereNull('email')->orderby('id')->first();
        session(['StudentManage' => 'create']);
        $mnge='create';
        //return view('admin.CreateStudent',compact("html_cource_ckbox","stud_inf","student_serial","html_grade_slct","mnge"));
        return view('admin.CreateStudent',compact("email_array","protector_array","html_cource_ckbox","stud_inf","html_grade_slct","mnge"));
    }

    public function edit(Student $Student)
    {
        session(['StudentManage' => 'modify']);
        return view('students.CreateStudent', ['Student' => $Student]);
    }
    
    public function update(Request $request, $id)
    {
        
        $email=implode( ",", $request->email_array );
        $protector=implode( ",", $request->protector_array );
        $course = implode( ",", $request->course );

        $student = Student::find($id);
        $student->update([
            //'serial_student'=>$request->serial_student,

            'email'=>$email,
            'name_sei'=>$request->name_sei,
            'name_mei'=>$request->name_mei,
            'name_sei_kana'=>$request->name_sei_kana,
            'name_mei_kana'=>$request->name_mei_kana,
            'protector'=>$protector,
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
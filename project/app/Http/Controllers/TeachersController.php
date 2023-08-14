<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\OtherFunc;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreTeacherRequest;
use App\Models\Student;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class TeachersController extends Controller
{
    
    public function send_mail(Request $request)
    {
        $StudentInf=Student::where('serial_student','=',$request->student_serial)->first();
        Mail::send(new ContactMail($StudentInf));
        return view('admin.StandbyDisplay');
    }

    public function show_standby_display()
    {
        //return view('admin.ListTeachers');
        //print "test";
        return view('admin.StandbyDisplay');
    }

    public function store_password(StoreTeacherRequest $request)
    {
        $teacher = User::find($request->id_teacher);
        $flg=Hash::check($request->OldPass, $teacher->password);
        if(Hash::check($request->OldPass, $teacher->password)){
            $teacher->update([
                'password'=>Hash::make($request->NewPassword),
            ]);
        }
        else{
            session()->flash('flash.error', '現在のパスワードが一致しません。');
            return back()->withInput();
        }
    }
    
    public function show_change_password(Request $request,$id)
    {
        $teacher_inf = User::find($id);
        return view('admin.ChangePassword',compact("id","teacher_inf"));
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.ListTeachers');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mnge='create';
        $teacher_serial=OtherFunc::get_teacher_new_serial();
        $teacher_serial++;
        $teacher_inf=User::where('serial_user','=',"0000")->first();
        $html_rank_ckbox=OtherFunc::make_html_course_ckbox("");
        session(['TeacherManage' => 'create']);
        return view('admin.CreateTeacher',compact("html_rank_ckbox","mnge","teacher_serial","teacher_inf"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rank = implode( ",", $request->course );

        User::create([
            'serial_user'=>$request->serial_teacher,
            'email'=>$request->email,
            'name_sei'=>$request->name_sei,
            'name_mei'=>$request->name_mei,
            'name_sei_kana'=>$request->name_sei_kana,
            'name_mei_kana'=>$request->name_mei_kana,
            'phone'=>$request->phone,
            'note'=>$request->note,
            'rank'=>$rank,
            'password'=>Hash::make($request->password),
        ]);
        $msg="登録しました。";
        $mnge='create';
        return view('admin.ListTeachers');
        //return view('admin.menu_after_student_store',compact("msg","mnge"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //return view('books.show', ['book' => $book]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    //public function edit(User $user)
    public function edit(Request $request)
    {
        session(['fromPage' => 'InputStudent']);
		$teacher_inf=User::where('serial_user','=',$request->TeacherSerial_Btn)->first();
        //$html_grade_slct=OtherFunc::make_html_grade_slct($stud_inf->grade);
        $html_rank_ckbox=OtherFunc::make_html_course_ckbox($teacher_inf->rank);
        $teacher_serial=$teacher_inf->serial_user;
        $mnge='modify';
        return view('admin.CreateTeacher',compact("html_rank_ckbox","teacher_inf","teacher_serial","mnge"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rank = implode( ",", $request->course );
        //print "id=".$id;
        $teacher = User::find($id);
        //$teacher->update($request->all());
        $teacher->update([
            'email'=>$request->email,
            'name_sei'=>$request->name_sei,
            'name_mei'=>$request->name_mei,
            'name_sei_kana'=>$request->name_sei_kana,
            'name_mei_kana'=>$request->name_mei_kana,
            'phone'=>$request->phone,
            'note'=>$request->note,
            'rank'=>$rank,
            'password'=>Hash::make($request->password),
        ]);
        $msg="修正しました。";
        $mnge='modify';
        $serial=$request->serial_teacher;
        return view('admin.menu_after_teacher_store',compact("msg","mnge","serial"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        return back();
    }
}
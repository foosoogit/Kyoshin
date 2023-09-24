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
use App\Models\InOutHistory;
use App\Http\Requests\StoreInOutHistoryRequest;
use App\Models\configration;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\InitConsts;
//use Illuminate\Database\Eloquent\Factories\Factory;

class TeachersController extends Controller
{
    //use Factory;
    //static $faker = Factory::create('ja_JP');
    //Factory::create('ja_JP')->userName();
    public function send_test_mail($type)
    {
        /*
        Mail::to($request->user());
            ->cc($moreUsers)
            ->bcc($evenMoreUsers)
            ->send(new OrderShipped($order));
        */
        $user = Auth::user();
        $target_item_array['to_email']=$user->email;
        $target_item_array['from_email']=$user->email;
        if($type=="MsgIn"){
            $msg=InitConsts::MsgIn();
            $sbj=InitConsts::sbjIn();
        }else if($type=="MsgOut"){
            $msg=InitConsts::MsgOut();
            $sbj=InitConsts::sbjOut();
        }else if($type=="MsgTest"){
            $msg=InitConsts::MsgTest();
            $sbj=InitConsts::sbjTest();
        }
        $msg=str_replace('[name-protector]', OtherFunc::randomName(), $msg);
        $msg=str_replace('[name-student]', OtherFunc::randomName(), $msg);
        $msg=str_replace('[time]', date("Y-m-d H:i:s"), $msg);
        $msg=str_replace('[name-jyuku]', InitConsts::JyukuName(), $msg);
        $target_item_array['msg']=$msg."\r\n".InitConsts::MsgFooter();

        $sbj=str_replace('[name-protector]', OtherFunc::randomName(), $sbj);
        $sbj=str_replace('[name-student]', OtherFunc::randomName(), $sbj);
        $sbj=str_replace('[time]', date("Y-m-d H:i:s"), $sbj);
        $sbj=str_replace('[footer]', InitConsts::MsgFooter(), $sbj);
        $sbj=str_replace('[name-jyuku]', InitConsts::JyukuName(), $sbj);
        $target_item_array['subject']=$sbj;
        Mail::send(new ContactMail($target_item_array));
    }

    public function update_setting(Request $request)
    {
        $configration_all_array=configration::all();
        foreach($configration_all_array as $configration_array){
            if(isset($_POST[$configration_array['subject']])){

                $udsql=configration::where('subject','=',$configration_array['subject'])
                    ->update(['value1' => $_POST[$configration_array['subject']]]);

            }
        }
        $configration_all_array=configration::all();
        foreach($configration_all_array as $configration){
            $configration_array[$configration['subject']]=$configration['value1'];
        }
        
        if(isset($request->SendMsgInBtn)){
            $this->send_test_mail("MsgIn");
        }else if(isset($request->SendMsgOutBtn)){
            $this->send_test_mail("MsgOut");
        }else if(isset($request->SendMsgTestBtn)){
            $this->send_test_mail("MsgTest");
        }
        return view('admin.Setting',compact("configration_array"));
    }

    public function show_setting()
    {
        $configration_all=configration::all();
        foreach($configration_all as $configration){
            $configration_array[$configration['subject']]=$configration['value1'];
        }
        return view('admin.Setting',compact("configration_array"));
    }

    public function send_mail(StoreInOutHistoryRequest $request)
    {
        $StudentInfSql=Student::where('serial_student','=',$request->student_serial);
        if($StudentInfSql->count()>0){
            //$target_item_array['to_email']=$user->email;
            //$target_item_array['to_email']=$user->email;
            $user = Auth::user();
            $target_item_array['from_email']=$user->email;
            $StudentInf=$StudentInfSql->first();
            
            $target_item_array['target_time']=date("Y-m-d H:i:s");
            $target_item_array['target_date']=date("Y-m-d");
            $target_item_array['student_serial']=$request->student_serial;
            //$target_item_array['email']=$StudentInf->email;
            $target_item_array['to_email']=$StudentInf->email;
            $target_item_array['name_sei']=$StudentInf->name_sei;
            $target_item_array['name_mei']=$StudentInf->name_mei;
            $target_item_array['protector']=$StudentInf->protector;

            //$target_item_array['target_time']=$target_time;
            $serch_target_history=InOutHistory::where('student_serial','=',$request->student_serial)
                        ->where('target_date','=',date("Y-m-d"))
                        ->whereNull('time_out')
                        ->orderBy('id', 'desc');
            //dd($serch_target_history->toSql(), $serch_target_history->getBindings());
            if($serch_target_history->count()>0){
                session(['seated_type' => 'out']);
                $msg=InitConsts::MsgOut();
                $sbj=InitConsts::sbjOut();
                $target_history=$serch_target_history->first();
                //$targetRec=InOutHistory::find($target_history->id);
                
                //$target_item_array['type']='退室';
                //$target_item_array['type_word']='から退室';
                $inOutHistory = InOutHistory::find($target_history->id);
                $inOutHistory->update([  
                    "time_out" => $target_item_array['target_time'],  
                ]);  
            }else{
                session(['seated_type' => 'in']);
                $msg=InitConsts::MsgIn();
                $sbj=InitConsts::sbjIn();
                //$target_item_array['type']='入室';
                //$target_item_array['type_word']='に入室';
                InOutHistory::create([
                    'student_serial'=>$request->student_serial,
                    'target_date'=>$target_item_array['target_date'],
                    'time_in'=>$target_item_array['target_time'],
                    'student_name'=>$StudentInf->name_sei.' '.$StudentInf->name_mei,
                    'student_name_kana'=>$StudentInf->name_sei_kana.' '.$StudentInf->name_mei_kana,
                    'to_mail_address'=>$StudentInf->email,
                    'from_mail_address'=>'inf@szemi-gp.com',
                ]);
            }

            $msg=str_replace('[name-protector]', $StudentInf->protector, $msg);
            $msg=str_replace('[name-student]', $StudentInf->name_sei." ".$StudentInf->name_mei, $msg);
            $msg=str_replace('[time]', date("Y-m-d H:i:s"), $msg);
            $msg=str_replace('[name-jyuku]', InitConsts::JyukuName(), $msg);
            $target_item_array['msg']=$msg."\r\n".InitConsts::MsgFooter();

            $sbj=str_replace('[name-protector]', $StudentInf->protector, $sbj);
            $sbj=str_replace('[name-student]', $StudentInf->name_sei." ".$StudentInf->name_mei, $sbj);
            $sbj=str_replace('[time]', date("Y-m-d H:i:s"), $sbj);
            $sbj=str_replace('[footer]', InitConsts::MsgFooter(), $sbj);
            $sbj=str_replace('[name-jyuku]', InitConsts::JyukuName(), $sbj);
            $target_item_array['subject']=$sbj;
            Mail::send(new ContactMail($target_item_array));
        }else{

        }
        return view('admin.StandbyDisplay');
    }

    public function show_standby_display()
    {
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
        
        if(session('sort_key')=='time_in' || session('sort_key')=='time_out'){session('sort_key')=="";}
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
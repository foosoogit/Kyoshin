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
use App\Models\MailDelivery;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;
//use Illuminate\Database\Eloquent\Factories\Factory;

class TeachersController extends Controller
{
    public function update_MailAccount(Request $request)
    {
        $path = base_path('.env');
        if (file_exists($path)) {
            file_put_contents($path, str_replace(
                'ENV_TEST=' . config('app.ENV_TEST'),
                'ENV_TEST=' . $request->MAIL_FROM_ADDRESS,
                file_get_contents($path)
            ));
            file_put_contents($path, str_replace(
                'MAIL_MAILER=' . config('app.MAIL_MAILER'),
                'MAIL_MAILER=' . $request->MAIL_MAILER,
                file_get_contents($path)
            ));
            file_put_contents($path, str_replace(
                'MAIL_HOST=' . config('app.MAIL_HOST'),
                'MAIL_HOST=' . $request->MAIL_HOST,
                file_get_contents($path)
            ));
            file_put_contents($path, str_replace(
                'MAIL_PORT=' . config('app.MAIL_PORT'),
                'MAIL_PORT=' . $request->MAIL_PORT,
                file_get_contents($path)
            ));
            file_put_contents($path, str_replace(
                'MAIL_USERNAME=' . config('app.MAIL_USERNAME'),
                'MAIL_USERNAME=' . $request->MAIL_USERNAME,
                file_get_contents($path)
            ));
            file_put_contents($path, str_replace(
                'MAIL_PASSWORD=' . config('app.MAIL_PASSWORD'),
                'MAIL_PASSWORD=' . $request->MAIL_PASSWORD,
                file_get_contents($path)
            ));
            file_put_contents($path, str_replace(
                'MAIL_ENCRYPTION=' . config('app.MAIL_ENCRYPTION'),
                'MAIL_ENCRYPTION=' . $request->MAIL_ENCRYPTION,
                file_get_contents($path)
            ));
            file_put_contents($path, str_replace(
                'MAIL_FROM_ADDRESS=' . config('app.MAIL_FROM_ADDRESS'),
                'MAIL_FROM_ADDRESS=' . $request->MAIL_FROM_ADDRESS,
                file_get_contents($path)
            ));
            file_put_contents($path, str_replace(
                'MAIL_FROM_NAME=' . config('app.MAIL_FROM_NAME'),
                'MAIL_FROM_NAME=' . $request->MAIL_FROM_NAME,
                file_get_contents($path)
            ));
        }
        /*
        $env_array=array();
        $env_array['MAIL_MAILER']=config('app.MAIL_MAILER');
        $env_array['MAIL_HOST']=env('MAIL_HOST');
        $env_array['MAIL_PORT']=env('MAIL_PORT');
        $env_array['MAIL_USERNAME']=env('MAIL_USERNAME');
        $env_array['MAIL_PASSWORD']=env('MAIL_PASSWORD');
        $env_array['MAIL_ENCRYPTION']=env('MAIL_ENCRYPTION');
        $env_array['MAIL_FROM_ADDRESS']=env('MAIL_FROM_ADDRESS');
        $env_array['MAIL_FROM_NAME']=env('MAIL_FROM_MAIL_FROM_NAME');
        */
        return redirect('show_email_account_setup');
        //return view('admin.MailAccountSetting',compact("env_array"));
    }
    
    public function show_email_account_setup(){
        $env_array=array();
        $env_array['MAIL_MAILER']=env('MAIL_MAILER');
        $env_array['MAIL_HOST']=env('MAIL_HOST');
        $env_array['MAIL_PORT']=env('MAIL_PORT');
        $env_array['MAIL_USERNAME']=env('MAIL_USERNAME');
        $env_array['MAIL_PASSWORD']=env('MAIL_PASSWORD');
        $env_array['MAIL_ENCRYPTION']=env('MAIL_ENCRYPTION');
        $env_array['MAIL_FROM_ADDRESS']=env('MAIL_FROM_ADDRESS');
        $env_array['MAIL_FROM_NAME']=env('MAIL_FROM_NAME');

        return view('admin.MailAccountSetting',compact("env_array"));
    }

    public function show_delivery_email(){
        $show_list_students_html = [];
        $show_list_students_html[] = '<iframe src="show_delivery_email_list_students" style="display:block;width:100%;height:100%;" class="h6" id="StudList_if" ></iframe>';
        $show_list_students_html= implode("", $show_list_students_html);
        $show_deliverid_history_html[] = '<iframe src="show_delivery_email_history_list" style="display:block;width:100%;height:100%;" class="h6" id="StudList_if" ></iframe>';
        $show_deliverid_history_html=implode("", $show_deliverid_history_html);
        return view('admin.CreateMail',compact("show_list_students_html","show_deliverid_history_html")); 
    }
    
    public function execute_mail_delivery(Request $request){
        $user = Auth::user();
        $msg=$request->body;
        $msg=str_replace('[name-protector]', OtherFunc::randomName(), $msg);
        $msg=str_replace('[name-student]', OtherFunc::randomName(), $msg);
        $msg=str_replace('[time]', date("Y-m-d H:i:s"), $msg);
        $msg=str_replace('[footer]', InitConsts::MsgFooter(), $msg);
        $msg=str_replace('[name-jyuku]', InitConsts::JyukuName(), $msg);
        $target_item_array['msg']=$msg;
                
        $sbj=$request->subject;
        $sbj=str_replace('[name-protector]', OtherFunc::randomName(), $sbj);
        $sbj=str_replace('[name-student]', OtherFunc::randomName(), $sbj);
        $sbj=str_replace('[time]', date("Y-m-d H:i:s"), $sbj);
        $sbj=str_replace('[footer]', InitConsts::MsgFooter(), $sbj);
        $sbj=str_replace('[name-jyuku]', InitConsts::JyukuName(), $sbj);
        $target_item_array['subject']=$sbj;
        $target_item_array['from_email']=$user->email;
        $student_serial_array=explode(',', $request->student_serial_hdn);
        $target_stud_email_array=array();
        foreach($student_serial_array as $student_serial){
            $target_stud_inf_array=Student::where("serial_student","=",$student_serial)->first();
            $to_email_array=explode(",",$target_stud_inf_array->email);
            $protector_array=explode(",",$target_stud_inf_array->protector);
            $target_stud_name_array[]=$target_stud_inf_array->name_sei.$target_stud_inf_array->name_mei;
            $target_item_array['to_email']=$target_stud_inf_array->email;
            $i=0;
            foreach($to_email_array as $target_email){
                $target_item_array['msg']=str_replace('[name-protector]', $protector_array[$i], $msg);
                $target_item_array['to_email']=$target_email;
                Mail::send(new ContactMail($target_item_array));
                //Mail::send(new ContactMail($target_item_array));
                $i++;
            }
        }
        $send_mail=implode( ",", $target_stud_email_array );
        $send_mname=implode( ",", $target_stud_name_array );
        
        MailDelivery::updateOrInsert(
            ['id' => $request->id],
            ['student_serial' => $request->student_serial_hdn, 'date_delivered' => date("Y-m-d H:i:s"), 'to_mail_address' => $send_mail, 'student_name'=>$send_mname,'from_mail_address' =>$user->email, 'subject' => $sbj, 'body' => $msg]
        );

        $show_list_students_html = [];
        $show_list_students_html[] = '<iframe src="show_delivery_email_list_students" style="display:block;width:100%;height:100%;" class="h6" id="StudList_if" ></iframe>';
        $show_list_students_html= implode("", $show_list_students_html);
        $show_deliverid_history_html[] = '<iframe src="show_delivery_email_history_list" style="display:block;width:100%;height:100%;" class="h6" id="StudList_if" ></iframe>';
        $show_deliverid_history_html=implode("", $show_deliverid_history_html);
        return view('admin.CreateMail',compact("show_list_students_html","show_deliverid_history_html")); 
    }
    
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
        $sbj=str_replace('[footer]', InitConsts::MsgFooter(), $sbj);
        $target_item_array['msg']=$msg;

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
        session(['time_now'=>date('Y-m-d H:i:s')]);
        //print "date=".date('Y-m-d H:i:s');
        $StudentInfSql=Student::where('serial_student','=',$request->student_serial);
        if($StudentInfSql->count()>0){
            $user = Auth::user();
            $target_item_array['from_email']=$user->email;
            $StudentInf=$StudentInfSql->first();
            
            $target_item_array['target_time']=date("Y-m-d H:i:s");
            $target_item_array['target_date']=date("Y-m-d");
            $target_item_array['student_serial']=$request->student_serial;
            
            //$target_item_array['to_email']=explode (",",$StudentInf->email);
            $to_email_array=explode (",",$StudentInf->email);
            $target_item_array['name_sei']=$StudentInf->name_sei;
            $target_item_array['name_mei']=$StudentInf->name_mei;
            //$target_item_array['protector']=explode (",",$StudentInf->protector);
            $protector_array=explode (",",$StudentInf->protector);
            $serch_target_history_sql=InOutHistory::where('student_serial','=',$request->student_serial)
                        ->where('target_date','=',date("Y-m-d"))
                        ->whereNull('time_out')
                        ->orderBy('id', 'desc');
            if($serch_target_history_sql->count()>0){
                $serch_target_history_array=$serch_target_history_sql->first();
                //$_SESSION['time_in']=$serch_target_history_array->time_in;
                session(['time_in' => $serch_target_history_array->time_in]);
                session(['time_now'=>date('Y-m-d H:i:s')]);
                session(['interval'=>self::time_diff(session('time_in'), session('time_now'))]);
                if(session('interval')['minutes']<5){
                    session(['seated_type' => 'false']);
                    //$_SESSION['seated_type']='false';
                }else{
                    session(['seated_type' => 'out']);
                    $msg=InitConsts::MsgOut();
                    $sbj=InitConsts::sbjOut();
                    //$target_history=$serch_target_history->first();
                    $inOutHistory = InOutHistory::find($serch_target_history_array->id);
                    $inOutHistory->update([  
                        "time_out" => $target_item_array['target_time'],  
                    ]);
                }  
            }else{
                session(['seated_type' => 'in']);
                $msg=InitConsts::MsgIn();
                $sbj=InitConsts::sbjIn();
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
            if(session('seated_type')<>'false'){

                $msg=str_replace('[name-student]', $StudentInf->name_sei." ".$StudentInf->name_mei, $msg);
                $msg=str_replace('[time]', date("Y-m-d H:i:s"), $msg);
                $msg=str_replace('[name-jyuku]', InitConsts::JyukuName(), $msg);
                $msg=str_replace('[footer]', InitConsts::MsgFooter(), $msg);
                
                $sbj=str_replace('[name-protector]', $StudentInf->protector, $sbj);
                $sbj=str_replace('[name-student]', $StudentInf->name_sei." ".$StudentInf->name_mei, $sbj);
                $sbj=str_replace('[time]', date("Y-m-d H:i:s"), $sbj);
                $sbj=str_replace('[footer]', InitConsts::MsgFooter(), $sbj);
                $sbj=str_replace('[name-jyuku]', InitConsts::JyukuName(), $sbj);
                $target_item_array['subject']=$sbj;
                $i=0;
                foreach($to_email_array as $target_email){
                    $target_item_array['msg']=str_replace('[name-protector]', $protector_array[$i], $msg);
                    $target_item_array['to_email']=$target_email;
                    Mail::send(new ContactMail($target_item_array));
                    $i++;
                }
            }
        }else{

        }
        return view('admin.StandbyDisplay');
    }

    
    public function time_diff($d1, $d2){
        //初期化
        $diffTime = array();
        //タイムスタンプ
        $timeStamp1 = strtotime($d1);
        $timeStamp2 = strtotime($d2);
        //print "timeStamp1=".$timeStamp1;
        //タイムスタンプの差を計算
        $difSeconds = $timeStamp2 - $timeStamp1;
        //秒の差を取得
        $diffTime['seconds'] = $difSeconds % 60;
        //分の差を取得
        $difMinutes = ($difSeconds - ($difSeconds % 60)) / 60;
        $diffTime['minutes'] = $difMinutes % 60;
        //時の差を取得
        $difHours = ($difMinutes - ($difMinutes % 60)) / 60;
        $diffTime['hours'] = $difHours;
        //結果を返す
        return $diffTime;
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
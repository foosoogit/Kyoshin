<?php
namespace App\Http\Livewire;
//session_start();
use App\Models\Student;
use Livewire\Component;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Log;

class StandbyDisplay extends Component
{
    //const $_SESSION['seated_type']="";
    public $time_in;
    public $time_now;
    public function send_mail()
    {
        $StudentInfSql=Student::where('serial_student','=',$request->student_serial);
        $_SESSION['time_now']=date('Y-m-d H:i:s');
        $this->time_now=date('Y-m-d H:i:s');
        if($StudentInfSql->count()>0){
            $user = Auth::user();
            $target_item_array['from_email']=$user->email;
            $StudentInf=$StudentInfSql->first();
            
            $target_item_array['target_time']=date("Y-m-d H:i:s");
            $target_item_array['target_date']=date("Y-m-d");
            $target_item_array['student_serial']=$request->student_serial;
            $target_item_array['to_email']=$StudentInf->email;
            $target_item_array['name_sei']=$StudentInf->name_sei;
            $target_item_array['name_mei']=$StudentInf->name_mei;
            $target_item_array['protector']=$StudentInf->protector;
            $serch_target_history=InOutHistory::where('student_serial','=',$request->student_serial)
                        ->where('target_date','=',date("Y-m-d"))
                        ->whereNull('time_out')
                        ->orderBy('id', 'desc');
            $_SESSION['seated_type']='false';
            if($serch_target_history->count()>0){
                //$this->time_in=$serch_target_history->time_in;
                $_SESSION['time_in']=$serch_target_history->time_in;
                session(['time_in' => $serch_target_history->time_in]);
                $_SESSION['time_now']=date('Y-m-d H:i:s');
                $_SESSION['interval']=time_diff($_SESSION['time_in'], $_SESSION['time_now']);
                //Log::emergency('time_now1='.date('Y-m-d H:i:s'));
                if($_SESSION['interval']['minutes']>5){
                    $_SESSION['seated_type']='false';
                }else{
                    //session(['seated_type' => 'out']);
                    $_SESSION['seated_type']='out';
                    $msg=InitConsts::MsgOut();
                    $sbj=InitConsts::sbjOut();
                    $target_history=$serch_target_history->first();
                    $inOutHistory = InOutHistory::find($target_history->id);
                    $inOutHistory->update([  
                        "time_out" => $target_item_array['target_time'],  
                    ]);
                }
            }else{
                //session(['seated_type' => 'in']);
                $_SESSION['seated_type']='in';
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
            }
            $_SESSION['seated_type']='false';
            session(['seated_type' => 'false']);
            //session(['interval' => $interval]);
        }
    }
    public function render()
    {
        //$_SESSION['time_now']=date('Y-m-d H:i:s');
        //Log::emergency('time_now2='.session('time_now'));
        //Log::emergency('time_now3='.$this->time_now);
        
        //print 'time_now='.session('time_now')."<br>";
        //print_r(session('interval'));
    
        $interval=session('interval');
        if(session('seated_type')=="in"){
            ?>
            <script type="text/javascript">
                //console.log("TEST in");
                var audio = new Audio("true.mp3"); 
                audio.play();
            </script>
            <?php
        }else if(session('seated_type')=="out"){
            ?>
            <script type="text/javascript">
                //console.log("TEST out");
                var audio = new Audio("time_out.mp3"); 
                audio.play();
            </script>
            <?php 
        }else if(session('seated_type')=="false"){
            ?>
            <script type="text/javascript">
                //console.log("TEST out");
                var audio = new Audio("false.mp3"); 
                audio.play();
            </script>
            <?php 
        }
        $type=session('seated_type');
        return view('livewire.standby-display',compact('type'));
    }
}

function time_diff($d1, $d2){
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
?>
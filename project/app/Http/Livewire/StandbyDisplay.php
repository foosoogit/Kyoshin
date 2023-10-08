<?php
namespace App\Http\Livewire;
use App\Models\Student;
use App\Models\InOutHistory;
use App\Http\Controllers\InitConsts;
use Livewire\Component;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\DB;

class StandbyDisplay extends Component
{
    public $type,$user,$target_item_array=array(),$student_serial,$seated_msg;
    /*
    public function send_mail_wire()
    {
        //session(['student_serial' => $student_serial]);
        Log::alert('student_serial-1='.$this->student_serial);
        //Log::alert('student_serial-2='.$student_serial);
        $StudentInfSql=Student::where('serial_student','=',$this->student_serial);
        session(['time_now' => date('Y-m-d H:i:s')]);
        if($StudentInfSql->count()>0){
            $target_item_array['from_email']=config('app.MAIL_FROM_ADDRESS');
            $StudentInf=$StudentInfSql->first();
            $target_item_array['target_time']=date("Y-m-d H:i:s");
            $target_item_array['target_date']=date("Y-m-d");
            $target_item_array['student_serial']=$this->student_serial;
            $target_item_array['to_email']=$StudentInf->email;
            $target_item_array['name_sei']=$StudentInf->name_sei;
            $target_item_array['name_mei']=$StudentInf->name_mei;
            $target_item_array['protector']=$StudentInf->protector;
            $serch_target_history=InOutHistory::where('student_serial','=',$this->student_serial)
                        ->where('target_date','=',date("Y-m-d"))
                        ->whereNull('time_out')
                        ->orderBy('id', 'desc');
            //session(['seated_type'=>'false']);
            //$seated_type='false';
            session(['seated_type'=>'false']);
            Log::alert('seated_type-1='.session('seated_type'));
            if($serch_target_history->count()>0){
                $serch_target_history_array=$serch_target_history->first();
                session(['time_in' => $serch_target_history_array->time_in]);
                session(['interval'=>self::time_diff_seconds(session('time_in'), session('time_now'))]);
                //Log::alert('time_in'.$serch_target_history_array->time_in);
                //Log::alert('time_now'.session('time_now'));
                //Log::alert('interval='.session('interval'));
                if(session('interval')<300){
                    session(['seated_type'=>'false']);
                }else{
                    //$seated_type='out';
                    session(['seated_type'=>'out']);
                    //session(['seated_type'=>'out']);
                    $msg=InitConsts::MsgOut();
                    $sbj=InitConsts::sbjOut();
                    $target_history=$serch_target_history->first();
                    $inOutHistory = InOutHistory::find($target_history->id);
                    $inOutHistory->update([  
                        "time_out" => $target_item_array['target_time'],  
                    ]);
                }
            }else{
                //$seated_type='in';
                session(['seated_type'=>'in']);
                //session(['seated_type'=>'in']);
                $msg=InitConsts::MsgIn();
                $sbj=InitConsts::sbjIn();
                InOutHistory::create([
                    'student_serial'=>$this->student_serial,
                    'target_date'=>$target_item_array['target_date'],
                    'time_in'=>$target_item_array['target_time'],
                    'student_name'=>$StudentInf->name_sei.' '.$StudentInf->name_mei,
                    'student_name_kana'=>$StudentInf->name_sei_kana.' '.$StudentInf->name_mei_kana,
                    'to_mail_address'=>$StudentInf->email,
                    'from_mail_address'=>'inf@szemi-gp.com',
                ]);
            }
            //if(session('seated_type')<>'false'){
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
        }
        //Log::alert('seated_type1='.session('seated_type'));
       
    }
    */

    public function render()
    {
        ?>
            <script type="text/javascript">
                var audio_out= new Audio("time_out.mp3");
		        var audio_in= new Audio("true.mp3");
		        var audio_false= new Audio("false.mp3");
            </script>
        <?php
        Log::alert('student_serial-1='.$this->student_serial);
        session(['seated_type'=>'']);
        $StudentInfSql=Student::where('serial_student','=',$this->student_serial);
        Log::alert('count='.$StudentInfSql->count());
        //$this->seated_type="";
        if($StudentInfSql->count()>0){
            $target_item_array['from_email']=config('app.MAIL_FROM_ADDRESS');
            $StudentInf=$StudentInfSql->first();
            $target_item_array['target_time']=date("Y-m-d H:i:s");
            $target_item_array['target_date']=date("Y-m-d");
            $target_item_array['student_serial']=$this->student_serial;
            $target_item_array['to_email']=$StudentInf->email;
            $target_item_array['name_sei']=$StudentInf->name_sei;
            $target_item_array['name_mei']=$StudentInf->name_mei;
            $target_item_array['protector']=$StudentInf->protector;
            $serch_target_history=InOutHistory::where('student_serial','=',$this->student_serial)
                        ->where('target_date','=',date("Y-m-d"))
                        ->whereNull('time_out')
                        ->orderBy('id', 'desc');
            session(['seated_type'=>$serch_target_history]);            
            
            Log::alert('history count='.$serch_target_history->count());
            if($serch_target_history->count()>0){
                $serch_target_history_array=$serch_target_history->first();
                session(['time_in' => $serch_target_history_array->time_in]);
                session(['interval'=>self::time_diff_seconds(session('time_in'), $target_item_array['target_time'])]);
                Log::alert('time_in='.session('time_in'));
                Log::alert('now='.$target_item_array['target_time']);
                Log::alert('interval='.session('interval'));
                if(session('interval')<300){
                    ?>
                    <script type="text/javascript">
                        var audio= new Audio("false.mp3");
                    </script>
                    <?php
                    Log::alert('interval false='.session('interval'));
                    /*
                    ?>
                    <script type="text/javascript">
                        var audio = new Audio("false.mp3"); 
                        audio.play();
                    </script>
                    <?php 
                    */
                    Log::alert('interval2 false='.session('interval'));
                    session(['seated_type'=>'false']);
                    
                    //$this->seated_type='false';
                    Log::alert('seated_type-2='.session('seated_type'));
                }else{
                    ?>
                    <script type="text/javascript">
                        var audio= new Audio("time_out.mp3");
                    </script>
                <?php
                    /*
                    ?>
                    <script type="text/javascript">
                    var audio = new Audio("time_out.mp3"); 
                    audio.play();
                    </script>
                    <?php
                    */
                    session(['seated_type'=>'out']);

                    //$this->seated_type='out';
                    Log::alert('seated_type-3='.session('seated_type'));
                    
                    $msg=InitConsts::MsgOut();
                    $sbj=InitConsts::sbjOut();
                    $target_history=$serch_target_history->first();
                    $inOutHistory = InOutHistory::find($target_history->id);
                    $inOutHistory->update([  
                        "time_out" => $target_item_array['target_time'],  
                    ]);
                    
                }
            }else{
                ?>
                <script type="text/javascript">
                    var audio= new Audio("true.mp3");
                    </script>
            <?php
                /*
                ?>
                <script type="text/javascript">
                    //console.log("TEST in");
                    var audio = new Audio("true.mp3"); 
                    audio.play();
                </script>
                <?php
                */
                session(['seated_type'=>'in']);
   
                //$this->seated_type='in';
                Log::alert('seated_type-4='.session('seated_type'));
                $msg=InitConsts::MsgIn();
                $sbj=InitConsts::sbjIn();
                InOutHistory::create([
                    'student_serial'=>$this->student_serial,
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
                //Mail::send(new ContactMail($target_item_array));
            }
        }
        /*
        //session(['student_serial' => $student_serial]);
        //session(['student_serial' => $student_serial]);
        Log::alert('student_serial1='.$this->student_serial);
        //Log::alert('student_serial='.session('student_serial'));
        //Log::alert('seated_type3='.session('seated_type'));
        //if(session('seated_type')=="in"){
        session(['student_serial' => $this->student_serial]);
        Log::alert('student_serial2='.session('student_serial'));
        $StudentInfSql=Student::where('serial_student','=',session('student_serial'));
        
        //dd(DB::getQueryLog());
        Log::alert(dump($StudentInfSql->toSql(), $StudentInfSql->getBindings()));
        //Log::alert('student_serial2='.$this->student_serial);
        if($StudentInfSql->count()>0){
            $StudentInf=$StudentInfSql->first();
            $target_item_array['target_time']=date("Y-m-d H:i:s");
            $target_item_array['target_date']=date("Y-m-d");
            $target_item_array['student_serial']=$this->student_serial;
            $target_item_array['to_email']=$StudentInf->email;
            $target_item_array['name_sei']=$StudentInf->name_sei;
            $target_item_array['name_mei']=$StudentInf->name_mei;
            $target_item_array['protector']=$StudentInf->protector;
            $target_item_array['from_email']=config('app.MAIL_FROM_ADDRESS');

            $serch_target_history=InOutHistory::where('student_serial','=',$this->student_serial)
                        ->where('target_date','=',date("Y-m-d"))
                        ->whereNull('time_out')
                        ->orderBy('id', 'desc');
            //dd($serch_target_history->toSql(), $serch_target_history->getBindings());
            //Log::alert('count='.$serch_target_history->count());            
            if($serch_target_history->count()>0){
                $serch_target_history_array=$serch_target_history->first();
                //session(['time_in' => $serch_target_history_array->time_in]);
                $time_in=$serch_target_history_array->time_in;
                //session(['time_now' => date('Y-m-d H:i:s')]);
                $time_now=date('Y-m-d H:i:s');
                //session(['interval'=>self::time_diff_seconds(session('time_in'), session('time_now'))]);
                $interval=self::time_diff_seconds(session('time_in'), session('time_now'));
                //Log::alert('time_in='.$time_in);
                //Log::alert('time_now='.$time_now);
                //Log::alert('interval='.$interval);
                //if(session('interval')<300){
                if($interval<300){
                    ?>
                    <script type="text/javascript">
                    var audio = new Audio("false.mp3"); 
                    audio.play();
                    </script>
                    <?php 
                    session(['seated_type'=>'false']);
                }else{
                    ?>
                    <script type="text/javascript">
                    var audio = new Audio("time_out.mp3"); 
                    audio.play();
                    </script>
                    <?php 
                                //$seated_type='out';
                    session(['seated_type'=>'out']);
                                //session(['seated_type'=>'out']);
                    $msg=InitConsts::MsgOut();
                    $sbj=InitConsts::sbjOut();
                    $target_history=$serch_target_history->first();
                    $inOutHistory = InOutHistory::find($target_history->id);
                    $inOutHistory->update([  
                        "time_out" => session('time_now'),  
                    ]);
                }
            }else{
                //log::alert('count2='.$serch_target_history->count());
                ?>
                <script type="text/javascript">
                    //console.log("TEST in");
                    var audio = new Audio("true.mp3"); 
                    audio.play();
                </script>
                <?php
                            //$seated_type='in';
                session(['seated_type'=>'in']);
                            //session(['seated_type'=>'in']);
                $msg=InitConsts::MsgIn();
                $sbj=InitConsts::sbjIn();
                InOutHistory::create([
                    'student_serial'=>session('student_serial'),
                    'target_date'=>$target_item_array['target_date'],
                    'time_in'=>$target_item_array['target_time'],
                    'student_name'=>$StudentInf->name_sei.' '.$StudentInf->name_mei,
                    'student_name_kana'=>$StudentInf->name_sei_kana.' '.$StudentInf->name_mei_kana,
                    'to_mail_address'=>$StudentInf->email,
                    'from_mail_address'=>$target_item_array['from_email'],
                ]);
            }
        }
                    /*
        if(session('seated_type')=="in"){
            ?>
            <script type="text/javascript">
                //console.log("TEST in");
                var audio = new Audio("true.mp3"); 
                audio.play();
            </script>
            <?php
        //}else if(session('seated_type')=="out"){
        }else if(session('seated_type')=="out"){
            ?>
            <script type="text/javascript">
                var audio = new Audio("time_out.mp3"); 
                audio.play();
            </script>
            <?php 
        //}else if(session('seated_type')=="false"){
        }else if(session('seated_type')=="false"){
            ?>
            <script type="text/javascript">
                var audio = new Audio("false.mp3"); 
                audio.play();
            </script>
            <?php 
        }
        //$type=session('seated_type');
        */
        //$this->student_serial="";
        Log::alert('seated_type-5='.session('seated_type'));
        //$student_serial="";
        //$student_serial="";
        //Log::alert('seated_type-6='.$this->seated_type);
        
        //if($this->seated_type=='in'){
        Log::alert("seated_type100=".session('seated_type'));
        //session(['seated_type'=>'out']);
        if(session('seated_type')=='in'){
            //Log::alert('in');
            ?>
            <script type="text/javascript">
                //var audio = new Audio("true.mp3"); 
                audio_in.play();
            </script>
            <?php 
            //$seated_msge="入室しました。";
            Log::alert('in2');
        //}else if($this->seated_type=='out'){
        }else if(session('seated_type')=='out'){
            //Log::alert('out');
            ?>
            <script type="text/javascript">
                //var audio = new Audio("time_out.mp3"); 
                audio_out.play();
            </script>
            <?php
            //$seated_msge="退室しました。";
            Log::alert('out2');
        //}else if($this->seated_type=='false'){
        }else if(session('seated_type')=='false'){
            //Log::alert('false');
            ?>
            <script type="text/javascript">
                audio_false.play();
            </script>
            <?php
            //$seated_msge="退室までに時間が短すぎます。";
            Log::alert('false2');
        }
        Log::alert('view2');
        switch (session('seated_type')){
            case 'in':
                ?>
                <script type="text/javascript">
                    //var audio = new Audio("true.mp3"); 
                    audio_in.play();
                </script>
                <?php 
               break;
           case 'out':
            ?>
            <script type="text/javascript">
                //var audio = new Audio("time_out.mp3"); 
                audio_out.play();
            </script>
            <?php
               break;
           case 'false':
            ?>
            <script type="text/javascript">
                audio_false.play();
            </script>
            <?php
            break;
       }

        ?>
            <script type="text/javascript">
                audio_in.play();
            </script>
        <?php

        $this->seated_type=session('seated_type');
        return view('livewire.standby-display');
    }

    public function time_diff_seconds($d1, $d2){
        $timeStamp1 = strtotime($d1);
        $timeStamp2 = strtotime($d2);
        $difSeconds = $timeStamp2 - $timeStamp1;
        return $difSeconds;
    }       
}
?>
<?php
namespace App\Http\Livewire;
//session_start();
use App\Models\Student;
use Livewire\Component;
use Illuminate\Support\Facades\Session;



class StandbyDisplay extends Component
{
    
    //const $_SESSION['seated_type']="";
    public function send_mail()
    {
        //print "student_serial=".$request->student_serial;
        //if()
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
                $_SESSION['seated_type']='out';
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
                $_SESSION['seated_type']='in';
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
        }
        //else{
        /*
        ?>
        <script type="text/javascript">
            console.log("TEST2");
        </script>
        <?php
        /*/
        //}
        //return view('admin.StandbyDisplay');
    }
    public function render()
    {
        /*
        if(session('seated_type')=="in"){
            $file='true.mp3'; 
        }else{
            $file='false_cnt.mp3';
        }
        var type = <?php $_SESSION['seated_type']; ?>;
        */

        if(session('seated_type')=="in"){
            ?>
            <script type="text/javascript">
                console.log("TEST in");
                var audio = new Audio("true.mp3"); 
                audio.play();
            </script>
            <?php
        }else{
            ?>
            <script type="text/javascript">
                console.log("TEST out");
                var audio = new Audio("false_cnt.mp3"); 
                audio.play();
            </script>
            <?php 
        }
        $type=session('seated_type');
        return view('livewire.standby-display',compact('type'));
    }
}
?>
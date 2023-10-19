<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\InOutHistory;
use App\Http\Controllers\OtherFunc;
use Livewire\WithPagination;
use App\Http\Controllers\InitConsts;
use Illuminate\Support\Facades\Log;

class ListRireki extends Component
{
    use WithPagination;
    public $sort_key_p = '',$asc_desc_p="",$serch_key_p="";
	public $kensakukey="";
    public static $key="";

    public function searchClear(){
		$this->serch_key_p="";
		$this->kensakukey="";
		session(['serchKey' => '']);
	}

    public function search_from_top_menu(Request $request){
        $this->serch_key_p=$request->input('user_serial');
		session(['serchKey' => $request->input('user_serial')]);
	}
    
    public function search(){
		if(session(['serchKey' => $this->kensakukey])==""){
           $this->serch_key_p=$this->kensakukey;
        }else{
	    	session(['serchKey' => $this->kensakukey]);
        }
	}

    public function search_from_rireki($user_serial){
		$this->serch_key_p=$user_serial;
		session(['serchKey' => $user_serial]);
	}

    public function sort($sort_key){
		$sort_key_array=array();
		$sort_key_array=explode("-", $sort_key);
		session(['sort_key' =>$sort_key_array[0]]);
		session(['asc_desc' =>$sort_key_array[1]]);
        //print "sort_key1=".session('sort_key');
	}

    public function render()
    {
        if(isset($_SERVER['HTTP_REFERER'])){
            OtherFunc::set_access_history($_SERVER['HTTP_REFERER']);
        }
        
        if(!isset($sort_key_p) and session('sort_key')==null){
            session(['sort_key' =>'']);
        }
        $this->sort_key_p=session('sort_key');
    
        if(!isset($asc_desc_p) and session('asc_desc')==null){
            session(['asc_desc' =>'ASC']);
        }
        $this->asc_desc_p=session('asc_desc');
    
        $InOutHistory = InOutHistory::query();
        $from_place="";$target_day="";$backdayly=false;
    
        if(session('serchKey')==""){
            session(['serchKey' => $this->serch_key_p]);
        }
        
        Log::alert('serchKey='.session('serchKey'));
        self::$key="%".session('serchKey')."%";
        $InOutHistory =$InOutHistory->where('student_serial','like',self::$key)
                    ->orwhere('time_in','like',self::$key)
                    ->orwhere('time_out','like',self::$key)
                    ->orwhere('student_name','like',self::$key)
                    ->orwhere('to_mail_address','like',self::$key);
    
        $targetSortKey="";
        if(session('sort_key')<>""){
            $targetSortKey=session('sort_key');
        }else{
            $targetSortKey=$this->sort_key_p;
        }

        if($this->sort_key_p<>''){
            if($this->asc_desc_p=="ASC"){
                $InOutHistory =$InOutHistory->orderBy($this->sort_key_p, 'asc');
            }else{
                $InOutHistory =$InOutHistory->orderBy($this->sort_key_p, 'desc');
            }
            /*
            if($this->sort_key_p=="name"){
                if($this->asc_desc_p=="ASC"){
                    $InOutHistory =$InOutHistory->orderBy('name_sei', 'asc');
                    $InOutHistory =$InOutHistory->orderBy('name_mei', 'asc');
                }else{
                    $InOutHistory =$InOutHistory->orderBy('name_sei', 'desc');
                    $InOutHistory =$InOutHistory->orderBy('name_mei', 'desc');
                }
            }else if($this->sort_key_p=="name_sei_kana"){
                if($this->asc_desc_p=="ASC"){
                    $InOutHistory =$InOutHistory->orderBy('name_sei_kana', 'asc');
                    $InOutHistory =$InOutHistory->orderBy('name_mei_kana', 'asc');
                }else{
                    $InOutHistory =$InOutHistory->orderBy('name_sei_kana', 'desc');
                    $InOutHistory =$InOutHistory->orderBy('name_mei_kana', 'desc');
                }
            }else{
                if($this->asc_desc_p=="ASC"){
                    $InOutHistory =$InOutHistory->orderBy($this->sort_key_p, 'asc');
                }else{
                    $InOutHistory =$InOutHistory->orderBy($this->sort_key_p, 'desc');
                }
            }
            */
        }

        if(session('target_page_for_pager')!==null){
            $targetPage=session('target_page_for_pager');
            session(['target_page_for_pager'=>null]);
        }else{
            $targetPage=null;
        }
        if(self::$key=="%%"){$targetPage=null;}
        //dd($InOutHistory->toSql(), $InOutHistory->getBindings());
        //dd($InOutHistory->dump());
        //print "sort_key=".session('sort_key');
		//print "asc_desc=".session('asc_desc');
        //$InOutHistory =$InOutHistory->orderBy('serial_student', 'asc');
        $histories=$InOutHistory->paginate($perPage = initConsts::DdisplayLineNumStudentsList(),['*'], 'page',$targetPage);
        
        //$teachers=$UserQuery->paginate($perPage = initConsts::DdisplayLineNumStudentsList(),['*'], 'page',$targetPage);
        return view('livewire.list-rireki',compact("histories"));
    }
}

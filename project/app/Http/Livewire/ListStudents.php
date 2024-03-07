<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Student;
use App\Http\Controllers\InitConsts;
use App\Http\Controllers\OtherFunc;
use Illuminate\Support\Collection;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
if(!isset($_SESSION)){session_start();}

class ListStudents extends Component
{
    use WithPagination;
    public $sort_key_p = '',$asc_desc_p="",$serch_key_p="",$targetPage=null;
	public $kensakukey="";
    public static $key="";
    public $Unregistered_flg=false;
    public $Retiree_flg=false;

    public $orderColumn = "serial_student";
    public $sortOrder = "asc";
    //public $serchColumn = "";
    public $StudentQuery="";

    public function registered(){
        if(session('registered_flg')=="checked"){
            session(['registered_flg' => ""]);
        }else{
            session(['registered_flg' => "checked"]);
        }
    }

    public function unregistered(){
        if(session('unregistered_flg')=="checked"){
            session(['unregistered_flg' => ""]);
        }else{
            session(['unregistered_flg' => "checked"]);
        }
    }

    public function withdrawn(){
        if(session('withdrawn_flg')=="checked"){
            session(['withdrawn_flg' => ""]);
        }else{
            session(['withdrawn_flg' => "checked"]);
        }
    }

    public function searchClear(){
        $this->serch_key_p="";
        $this->kensakukey="";
        $this->orderColumn = "serial_student";
        $this->sortOrder = "asc";
        $this->targetPage=null;
        $this->Unregistered_flg=false;
        $this->Retiree_flg=false;
    }

    public function search_from_top_menu(Request $request){
        $this->serch_key_p=$request->input('user_serial');
        session(['serchKey_stud' => $request->input('user_serial')]);
        $_SESSION['serchKey_stud']=$request->input('user_serial');
    }

    public function search(){
        $this->targetPage=1;
    }

    public function sort($sort_key){
        $sort_key_array=array();
        $sort_key_array=explode("-", $sort_key);
        $this->sortOrder=$sort_key_array[1];
        $this->orderColumn=$sort_key_array[0];
    }

    public function render(){
        if(isset($_SERVER['HTTP_REFERER'])){
            OtherFunc::set_access_history($_SERVER['HTTP_REFERER']);
        }
        $StudentQuery = Student::query();
        if(session('registered_flg')=="checked" && session('unregistered_flg')=="" && session('withdrawn_flg')==""){
            $StudentQuery =$StudentQuery->where('name_sei','<>',"")
                ->where('grade','<>','退会');
            //$StudentQuery=$StudentQuery->orderby($this->orderColumn,$this->sortOrder);
        }else if(session('registered_flg')=="checked" && session('unregistered_flg')=="" && session('withdrawn_flg')=="checked"){
            $StudentQuery =$StudentQuery->where('name_sei','=',"");
        }else if(session('registered_flg')=="checked" && session('unregistered_flg')=="checked" && session('withdrawn_flg')==""){
            $StudentQuery =$StudentQuery->where('grade','<>','退会')
                ->orwhere('grade','=',null);
        }else if(session('registered_flg')=="" && session('unregistered_flg')=="checked" && session('withdrawn_flg')=="checked"){
            $StudentQuery =$StudentQuery->where('grade','=','退会')
                ->orwhere('name_sei','=',"")
                ->orwhere('name_sei','=',null);
        }else if(session('registered_flg')=="" && session('unregistered_flg')=="" && session('withdrawn_flg')=="checked"){
            $StudentQuery =$StudentQuery->where('grade','=','退会');
        }else if(session('registered_flg')=="" && session('unregistered_flg')=="checked" && session('withdrawn_flg')==""){
            $StudentQuery =$StudentQuery->whereNull('name_sei')
                ->orwhere('name_sei','=',"");
        }
        if($this->kensakukey<>""){
            self::$key="%".$this->kensakukey."%";
            $StudentQuery =$StudentQuery->where('serial_student','like',self::$key)
                ->orwhere('name_sei','like',self::$key)
                ->orwhere('name_mei','like',self::$key)
                ->orwhere('name_sei_kana','like',self::$key)
                ->orwhere('name_mei_kana','like',self::$key)
                ->orwhere('grade','like',self::$key)
                ->orwhere('phone','like',self::$key)
                ->orwhere('course','like',self::$key);
        }
        $REQUEST_array=explode("page=", $_SERVER['REQUEST_URI']);
        if(isset($REQUEST_array[1])){
            session(['page_history' => $REQUEST_array[1]]);
        }
        if(!str_contains($_SERVER['HTTP_REFERER'], "students/list")){
            $students=$StudentQuery->paginate($perPage = initConsts::DdisplayLineNumStudentsList(),['*'], 'page',session('page_history'));
        }else{
            $students=$StudentQuery->paginate($perPage = initConsts::DdisplayLineNumStudentsList(),['*']);
        }
        //$students=$StudentQuery->paginate($perPage = initConsts::DdisplayLineNumStudentsList(),['*']);
        return view('livewire.list-students',['students'=>$students,]);
    }

    public function search_stud()
    {
        //try {
        if(isset($_SERVER['HTTP_REFERER'])){
            OtherFunc::set_access_history($_SERVER['HTTP_REFERER']);
        }
    
        $StudentQuery = Student::query();
        if(isset($_POST['btn_serial'])){
            $_SESSION['serchKey_stud']=$_POST['btn_serial'];
        //}else if(session('serchKey')==""){
        }else if(!isset($_SESSION['serchKey_stud'])){
            $_SESSION['serchKey_stud']=$this->serch_key_p;
        }
        $targetSortKey="";
        //if(session('sort_key')<>""){
        if(isset($_SESSION['sortKey_stud'])){
            $StudentQuery =$StudentQuery->orderBy($_SESSION['sortKey_stud'], $_SESSION['asc_desc_stud']);
        }


        /*
        if(session('sort_key')<>""){
            $StudentQuery =$StudentQuery->orderBy(session('sort_key'), session('asc_desc'));
            //$targetSortKey=session('sort_key');
        }
        */

        /*
        else{
            $targetSortKey=$this->sort_key_p;
        }
        */
        /*
        if($this->sort_key_p=='time_in' | $this->sort_key_p=='time_out'){
            $this->sort_key_p='serial_student';
        }
        */
        /*
        if($targetSortKey<>''){
            if($targetSortKey=="name_sei"){
                if($this->asc_desc_p=="ASC"){
                    $StudentQuery =$StudentQuery->orderBy('name_sei', 'asc');
                    $StudentQuery =$StudentQuery->orderBy('name_mei', 'asc');
                }else{
                    $StudentQuery =$StudentQuery->orderBy('name_sei', 'desc');
                    $StudentQuery =$StudentQuery->orderBy('name_mei', 'desc');
                }
            }else if($targetSortKey=="name_sei_kana"){
                if($this->asc_desc_p=="ASC"){
                    $StudentQuery =$StudentQuery->orderBy('name_sei_kana', 'asc');
                    $StudentQuery =$StudentQuery->orderBy('name_mei_kana', 'asc');
                }else{
                    $StudentQuery =$StudentQuery->orderBy('name_sei_kana', 'desc');
                    $StudentQuery =$StudentQuery->orderBy('name_mei_kana', 'desc');
                }
            }else{
                if(session('asc_desc')=="ASC"){
                    $StudentQuery =$StudentQuery->orderBy($targetSortKey, 'asc');
                }else{
                    $StudentQuery =$StudentQuery->orderBy($targetSortKey, 'desc');
                }
            }
        }
        */
        /*
        if($this->sort_key_p<>''){
            if($this->sort_key_p=="name_sei"){
                if($this->asc_desc_p=="ASC"){
                    $StudentQuery =$StudentQuery->orderBy('name_sei', 'asc');
                    $StudentQuery =$StudentQuery->orderBy('name_mei', 'asc');
                }else{
                    $StudentQuery =$StudentQuery->orderBy('name_sei', 'desc');
                    $StudentQuery =$StudentQuery->orderBy('name_mei', 'desc');
                }
            }else if($this->sort_key_p=="name_sei_kana"){
                if($this->asc_desc_p=="ASC"){
                    $StudentQuery =$StudentQuery->orderBy('name_sei_kana', 'asc');
                    $StudentQuery =$StudentQuery->orderBy('name_mei_kana', 'asc');
                }else{
                    $StudentQuery =$StudentQuery->orderBy('name_sei_kana', 'desc');
                    $StudentQuery =$StudentQuery->orderBy('name_mei_kana', 'desc');
                }
            }else{
                if($this->asc_desc_p=="ASC"){
                    $StudentQuery =$StudentQuery->orderBy($this->sort_key_p, 'asc');
                }else{
                    $StudentQuery =$StudentQuery->orderBy($this->sort_key_p, 'desc');
                }
            }
        }
        */

        //$this->students=$StudentQuery->paginate($perPage = initConsts::DdisplayLineNumStudentsList(),['*'], 'page',$targetPage);
        /*
        if(session('target_page_for_pager')!==null){
            //$targetPage=session('target_page_for_pager');
            session(['target_page_for_pager'=>null]);
            $targetPage=1;
        }else{
            $targetPage=null;
        }
        */
        /*
        if(self::$key=="%%"){
            $targetPage=null;
        }else{
            $targetPage=1;
        }
        */
        //session(['serchKey' => ""]);
        //Log::alert("serchKey=".session('serchKey'));
        /*
        if(session('serchKey')!==""){
            $targetPage=1;
        }
        */
        //$this->dispatchBrowserEvent('scroll-top');
        //Log::alert("Query=".$StudentQuery);
        //$this->students=Student::paginate();
        

        
        $this->students=$StudentQuery->paginate($perPage = initConsts::DdisplayLineNumStudentsList(),['*'], 'page',$this->targetPage);
        //} catch (QueryException $e) {
            //Log::alert("QueryException=".$e);
        //    return redirect('Students.List'); 
        //}
        
        //$this->students=$StudentQuery->paginate($perPage = initConsts::DdisplayLineNumStudentsList(),['*']);
        //$this->students=$StudentQuery->paginate($perPage = initConsts::DdisplayLineNumStudentsList(),$targetPage);
        //$this->students=$StudentQuery->paginate();
        $this->targetPage=null;
    }
}
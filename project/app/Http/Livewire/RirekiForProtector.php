<?php

namespace App\Http\Livewire;
use App\Models\Student;
use Illuminate\Support\Facades\Log;
use Livewire\WithPagination;
use App\Http\Controllers\InitConsts;
use App\Models\InOutHistory;

use Livewire\Component;

class RirekiForProtector extends Component
{
    public $msg;
    use WithPagination;
    public $sort_key_p = '',$asc_desc_p="",$serch_key_p="",$targetPage=null,$target_day="",$sort_type="";
	public $kensakukey="";
    public static $key="";
    protected $histories;

    public function render()
    {
        $this->search_stud();
        //Log::alert("target_day2=".$this->target_day);
        //$serial_student=session('target_stud_inf_array')->serial_student;
        //$guest_inf=Student::where('serial_student','=',$serial_student)->first();
        //Log::alert('histories='.$this->histories);
        return view('livewire.rireki-for-protector',['histories'=>$this->histories,'target_day'=>'']);
    }
    public function sort_day($target){
        Log::alert("sort_day=".$target);
        $sort_array=explode("-", $target);
        $this->sort_type=$sort_array[1];
        Log::alert("sort_type=".$this->sort_type);
    }
    public function search_day($target){
        Log::alert("target_day=".$target);
        $this->target_day=$target;
    }
    public function search_stud()
    {
        //Log::alert("target_day=".$this->target_day);
        try {
        $HistoriesQuery = InOutHistory::query();
        $HistoriesQuery =$HistoriesQuery->where('student_serial','=',session('target_stud_inf_array')->serial_student);
        if($this->target_day<>""){
            $HistoriesQuery = $HistoriesQuery->where('target_date','=',$this->target_day);
        }else{
            $this->target_day="";
        }
        if($this->sort_type<>""){
            $HistoriesQuery = $HistoriesQuery->orderBy('target_date',$this->sort_type); 
        }
        /*
        if($this->sort_key_p=='time_in' | $this->sort_key_p=='time_out'){
            $this->sort_key_p='id';
        }
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
            $this->histories=$HistoriesQuery->paginate($perPage = initConsts::DdisplayLineNumStudentsList(),['*'], 'page',$this->targetPage);
        } catch (QueryException $e) {
            //Log::alert("QueryException=".$e);
            //return redirect('Students.List'); 
        }
        
        //$this->students=$StudentQuery->paginate($perPage = initConsts::DdisplayLineNumStudentsList(),['*']);
        //$this->students=$StudentQuery->paginate($perPage = initConsts::DdisplayLineNumStudentsList(),$targetPage);
        //$this->students=$StudentQuery->paginate();
        $this->targetPage=null;
    }
}

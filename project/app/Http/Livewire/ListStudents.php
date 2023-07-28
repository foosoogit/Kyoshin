<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Student;
use App\Http\Controllers\InitConsts;
use Illuminate\Support\Collection;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class ListStudents extends Component
{
    use WithPagination;
    public function render()
    {
        $students=Student::paginate(initConsts::DdisplayLineNumStudentsList());
        return view('livewire.list-students',compact("students"));
    }
}

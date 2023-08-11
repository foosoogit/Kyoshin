<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\InitConsts;
use App\Models\Student;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    //return view('dashboard');
    return view('admin.menu');
})->middleware(['auth', 'verified'])->name('dashboard');

//Route::get('students/create', 'create')->name('student.create');
//Route::middleware('auth')->group(function () {
Route::group(['middleware' => ['auth']], function(){
    Route::put('students/{Student}', [\App\Http\Controllers\StudentController::class,'update'])->name('student.update');
    //Route::get('students/test', [\App\Http\Controllers\StudentController::class,'test'])->name('student.test');
    //Route::put('students/{student}', 'update')->name('student.update');
    
    Route::get('students/list', function () {
        return view('admin.ListStudents');
        //return view('livewire.list-students');
    });

    Route::post('students/list', function () {
        return view('admin.ListStudents');
        //return view('livewire.list-students');
    })->name('Students.List');
    
    Route::get('students/list_ck_store', function () {
        session(['serchKey' =>""]);
        session(['sort_key' =>"serial_student"]);
        session(['asc_desc' =>'desc']);
        return view('admin.ListStudents');
        //return view('livewire.list-students');
    })->name('Students.list_ck_store');

    Route::get('students/list_ck_modify/{stud_seraial}', [\App\Http\Controllers\StudentController::class,'ShowStudentModifyList'])->name('Students.list_ck_modify');

    Route::post('students/list_ck_store', function () {
        session(['serchKey' =>""]);
        session(['sort_key' =>"serial_student"]);
        session(['asc_desc' =>'desc']);
        return view('admin.ListStudents');
        //return view('livewire.list-students');
    })->name('Students.list_ck_store');

    /*
    Route::get('students/create', function () {
        $students_array=InitConsts::Grade();
        return view('admin.CreateStudent',compact("students_array"));
    })->name('Students.Create');
    */
    
    Route::get('students/store', function () {
        return view('admin.CreateStudent');
    })->name('students.store');

    //Route::get('students/{student}/edit', 'edit')->name('student.edit');
    Route::post('students/ShowInputStudent', [\App\Http\Controllers\StudentController::class,'ShowInputStudent'])->name('ShowInputStudent.Modify');
    
    Route::get('students/create', [\App\Http\Controllers\StudentController::class,'show_inp_store'])->name('Students.Create');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    //Route::post('students/create', 'store')->name('student.store');
    
    Route::post('students', [\App\Http\Controllers\StudentController::class,'store'])->name('student');
    Route::post('students/store', [\App\Http\Controllers\StudentController::class,'store'])->name('student.store');
    //Route::post('students/update', [\App\Http\Controllers\StudentController::class,'update'])->name('student.update');
    //Route::post('students/{student}', [\App\Http\Controllers\StudentController::class,'update'])->name('student.update');
    
    //Route::put('students/{student}', 'update')->name('student.update');
    //Route::post('admin', 'store')->name('student.store');
    //Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    //Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    //Route::controller(StudentController::class)->prefix('students')->name('students')->group(function() {
        /*
        Route::get('students/list', function () {
            return view('admin.ListStudents');
        })->name('StudentsList');
        */
        /*
        Route::get('students/create', 'create')->name('student.create');
        
        Route::get('students/{student}', 'show')->name('student.show');
        Route::get('students/{student}/edit', 'edit')->name('student.edit');
        Route::put('students/{student}', 'update')->name('student.update');
        Route::delete('students/{post}', 'destroy')->name('student.destroy');
        */
   //});
});

require __DIR__.'/auth.php';
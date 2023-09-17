<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\InitConsts;
use App\Models\Student;
use App\Http\Controllers\TeachersController;
use Illuminate\Http\Request;

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
    $user = User::first();
    Mail::send(new ContactMail($user));
    return view('welcome');
});

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/dashboard', function () {
Route::get('/menu', function () {
    //return view('dashboard');
    return view('admin.menu');
})->middleware(['auth', 'verified'])->name('menu');

//Route::get('students/create', 'create')->name('student.create');
//Route::middleware('auth')->group(function () {
Route::group(['middleware' => ['auth']], function(){

    Route::controller(TeachersController::class)->name('teachers.')->group(function() {
        Route::get('teachers', 'index')->name('index');
        Route::get('teachers/create', 'create')->name('create');
        Route::post('teachers', 'store')->name('store');
        Route::get('teachers/{teacher}', 'show')->name('show');
        //Route::get('teachers/{teacher}/edit', 'edit')->name('edit');
        Route::post('teachers/edit', 'edit')->name('edit');
        Route::put('teachers/{teacher}', 'update')->name('update');
        Route::delete('teachers/{teacher}', 'destroy')->name('destroy');
        Route::get('teachers/{id}/show_change_password', 'show_change_password')->name('show_change_password');
        Route::post('teachers/store_password', 'store_password')->name('store_password');
        //Route::get('teachers/show_standby_display', 'show_standby_display')->name('show_standby_display');
        Route::get('show_standby_display', function () {
            return view('admin.StandbyDisplay');
        })->name('show_standby_display');
        Route::get('show_standby_display','show_standby_display')->name('show_standby_display');
        Route::post('teachers','send_mail')->name('sendmail');
    });

    //Route::get('students/ShowRireki', [\App\Http\Controllers\StudentController::class,'ShowRireki'])->name('showRireki');

    Route::get('ShowRireki', function () {
        session(['serchKey' =>'']);
        session(['sort_key' =>"time_in"]);
        session(['asc_desc' =>'desc']);
        return view('admin.ListRireki');
    })->name('admin.showRireki');

    Route::post('ShowRireki', function (Request $request) {
        session(['serchKey' =>$request->studserial]);
        session(['sort_key' =>"time_in"]);
        session(['asc_desc' =>'desc']);
        return view('admin.ListRireki');
    })->name('admin.showRireki');

    //Route::post('students/ShowRireki', [\App\Http\Controllers\StudentController::class,'ShowRireki'])->name('showRireki');
    //Route::get('students/ShowRireki/{studserial}', [\App\Http\Controllers\StudentController::class,'ShowRireki'])->name('showRireki');
    Route::delete('students/delete/{StudentID}', [\App\Http\Controllers\StudentController::class,'destroy'])->name('student.delete');
    Route::put('students/{Student}', [\App\Http\Controllers\StudentController::class,'update'])->name('student.update');
    Route::get('students/list', function () {
        return view('admin.ListStudents');
    });
    Route::post('students/list', function () {
        return view('admin.ListStudents');
    })->name('Students.List');

    Route::get('students/list_ner_num', function () {
        session(['serchKey' =>""]);
        session(['sort_key' =>"email"]);
        session(['sort_key2' =>"id"]);
        session(['asc_desc' =>'ASC']);
        session(['asc_desc2' =>'ASC']);
        return view('admin.ListStudents');
    })->name('Students.NewNumList');

    Route::get('students/list_ck_store', function () {
        session(['serchKey' =>""]);
        session(['sort_key' =>"serial_student"]);
        session(['asc_desc' =>'desc']);
        return view('admin.ListStudents');
    })->name('Students.list_ck_store');
    Route::get('students/list_ck_modify/{stud_seraial}', [\App\Http\Controllers\StudentController::class,'ShowStudentModifyList'])->name('Students.list_ck_modify');
    Route::post('students/list_ck_store', function () {
        session(['serchKey' =>""]);
        session(['sort_key' =>"serial_student"]);
        session(['asc_desc' =>'desc']);
        return view('admin.ListStudents');
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
    
    Route::get('students/create', [\App\Http\Controllers\StudentController::class,'ShowInputNewStudent'])->name('Students.Create');

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
   Route::get('/logout', 'Auth\LoginController@logout');
});
require __DIR__.'/auth.php';
<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\InitConsts;

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
    Route::get('students/list', function () {
        return view('admin.ListStudents');
        //return view('livewire.list-students');
    });

    Route::post('students/list', function () {
        return view('admin.ListStudents');
        //return view('livewire.list-students');
    })->name('Students.List');

    /*
    Route::get('students/create', function () {
        $students_array=InitConsts::Grade();
        return view('admin.CreateStudent',compact("students_array"));
    })->name('Students.Create');
    */
    
    Route::get('students/store', function () {
        return view('admin.CreateStudent');
    })->name('students.store');

    Route::get('students/create', [\App\Http\Controllers\StudentController::class,'show_inp_store'])->name('Students.Create');

    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    //Route::post('students/create', 'store')->name('student.store');
    Route::post('students', [\App\Http\Controllers\StudentController::class,'store'])->name('student');
    Route::post('students/store', [\App\Http\Controllers\StudentController::class,'store'])->name('student.store');
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
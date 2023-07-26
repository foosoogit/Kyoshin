<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::controller(StudentController::class)->prefix('students')->name('students')->group(function() {
        Route::get('students/', 'list');
        Route::get('students/create', 'create')->name('create');
        Route::post('students/create', 'store')->name('store');
        Route::get('students/{student}', 'show')->name('show');
        Route::get('students/{student}/edit', 'edit')->name('edit');
        Route::put('students/{student}', 'update')->name('update');
        Route::delete('students/{post}', 'destroy')->name('destroy');
   });
});

require __DIR__.'/auth.php';

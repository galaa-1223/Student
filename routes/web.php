<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\TeacherAuthController;

use App\Http\Controllers\Teacher\TeacherController;
use App\Http\Controllers\Teacher\TeachersController as TeachersController;
use App\Http\Controllers\Teacher\StudentsController as StudentsController;
use App\Http\Controllers\Teacher\AngiController as AngiController;
use App\Http\Controllers\Teacher\HicheelController as HicheelController;
use App\Http\Controllers\Teacher\HuvaariController as HuvaariController;
use App\Http\Controllers\Teacher\MergejilController as MergejilController;
use App\Http\Controllers\Teacher\MergejilBagshController as MergejilBagshController;
use App\Http\Controllers\Teacher\TenhimController as TenhimController;
use App\Http\Controllers\Teacher\SettingsController as SettingsController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

/****************************************************************************/
/********************************** Student *********************************/
/****************************************************************************/

// Student Login
Route::get('student', [StudentAuthController::class, 'studentGet'])->name('studentLogin');
Route::get('student/login', [StudentAuthController::class, 'studentGetLogin'])->name('studentLogin');
Route::post('student/login', [StudentAuthController::class, 'studentLogin'])->name('studentLoginPost');
Route::get('student/logout', [StudentAuthController::class, 'studentLogout'])->name('logout');

Route::group(['prefix' => 'student','middleware' => 'studentauth'], function () {
	// student Dashboard
	Route::get('dashboard',[StudentController::class, 'dashboard'])->name('student-dashboard');	
	
	// Teacher
	Route::get('teachers',[TeachersController::class, 'index'])->name('student-teachers');
	Route::get('teachers/add',[TeachersController::class, 'add'])->name('student-teachers-add');
	Route::get('teachers/edit/{id}',[TeachersController::class, 'edit'])->name('teachers-edit');

	Route::post('teachers/add',[TeachersController::class, 'store'])->name('student-teachers-save');
	Route::post('teachers/edit/{id}',[TeachersController::class, 'update'])->name('student-teachers-edit');
	Route::post('teachers/delete/',[TeachersController::class, 'delete'])->name('student-teachers-delete-ajax');

	Route::delete('teachers/delete/{id}',[TeachersController::class, 'destroy'])->name('student-teachers-delete');

	// Angi
	Route::get('angi',[AngiController::class, 'index'])->name('student-angi');
	Route::get('angi/add',[AngiController::class, 'add'])->name('student-angi-add');
	Route::get('angi/edit/{id}',[AngiController::class, 'edit'])->name('angi-edit');

	Route::post('angi/add',[AngiController::class, 'store'])->name('student-angi-save');
	Route::post('angi/edit/{id}',[AngiController::class, 'update'])->name('student-angi-edit');

	Route::delete('angi/delete/{id}',[AngiController::class, 'destroy'])->name('student-angi-delete');

	// Mergejil
	Route::get('mergejil',[MergejilController::class, 'index'])->name('student-mergejil');
	Route::get('mergejil/add',[MergejilController::class, 'add'])->name('student-mergejil-add');
	Route::get('mergejil/edit/{id}',[MergejilController::class, 'edit'])->name('mergejil-edit');

	Route::post('mergejil/add',[MergejilController::class, 'store'])->name('student-mergejil-save');
	Route::post('mergejil/edit/{id}',[MergejilController::class, 'update'])->name('student-mergejil-edit');
	Route::post('mergejil/delete/',[MergejilController::class, 'delete'])->name('student-mergejil-delete-ajax');

	Route::delete('mergejil/delete/{id}',[MergejilController::class, 'destroy'])->name('student-mergejil-delete');

	// Mergejil Bagsh
	Route::get('mergejil_bagsh',[MergejilBagshController::class, 'index'])->name('student-mergejil_bagsh');
	Route::get('mergejil_bagsh/add',[MergejilBagshController::class, 'add'])->name('student-mergejil_bagsh-add');
	Route::get('mergejil_bagsh/edit/{id}',[MergejilBagshController::class, 'edit'])->name('mergejil_bagsh-edit');

	Route::post('mergejil_bagsh/add',[MergejilBagshController::class, 'store'])->name('student-mergejil_bagsh-save');
	Route::post('mergejil_bagsh/edit/{id}',[MergejilBagshController::class, 'update'])->name('student-mergejil_bagsh-edit');

	Route::delete('mergejil_bagsh/delete/{id}',[MergejilBagshController::class, 'destroy'])->name('student-mergejil_bagsh-delete');

	// Tenhim
	Route::get('tenhim',[TenhimController::class, 'index'])->name('student-tenhim');
	Route::get('tenhim/add',[TenhimController::class, 'add'])->name('student-tenhim-add');
	Route::get('tenhim/edit/{id}',[TenhimController::class, 'edit'])->name('tenhim-edit');

	Route::post('tenhim/add',[TenhimController::class, 'store'])->name('student-tenhim-save');
	Route::post('tenhim/edit/{id}',[TenhimController::class, 'update'])->name('student-tenhim-edit');
	Route::post('tenhim/delete/',[TenhimController::class, 'delete'])->name('student-tenhim-delete-ajax');

	Route::delete('tenhim/delete/{id}',[TenhimController::class, 'destroy'])->name('student-tenhim-delete');

	// Hicheel
	Route::get('hicheel',[HicheelController::class, 'index'])->name('student-hicheel');
	Route::get('hicheel/add',[HicheelController::class, 'add'])->name('student-hicheel-add');
	Route::get('hicheel/edit/{id}',[HicheelController::class, 'edit'])->name('hicheel-edit');

	Route::post('hicheel/add',[HicheelController::class, 'store'])->name('student-hicheel-save');
	Route::post('hicheel/edit/{id}',[HicheelController::class, 'update'])->name('student-hicheel-edit');
	Route::post('hicheel/delete/',[HicheelController::class, 'delete'])->name('student-hicheel-delete-ajax');

	Route::delete('hicheel/delete/{id}',[HicheelController::class, 'destroy'])->name('student-hicheel-delete');

	// Huvaari
	Route::get('huvaari',[HuvaariController::class, 'index'])->name('student-huvaari');
	Route::get('huvaari/bagsh/{bagshId}',[HuvaariController::class, 'bagsh'])->name('student-huvaari-bagsh');

	// Students
	Route::get('students',[StudentsController::class, 'index'])->name('student-students');
	Route::get('students/add',[StudentsController::class, 'add'])->name('student-students-add');
	Route::get('students/edit/{id}',[StudentsController::class, 'edit'])->name('students-edit');

	Route::post('students/add',[StudentsController::class, 'store'])->name('student-students-save');
	Route::post('students/edit/{id}',[StudentsController::class, 'update'])->name('student-students-edit');
	Route::post('students/delete/',[StudentsController::class, 'delete'])->name('student-students-delete-ajax');

	// Settings
	Route::get('settings',[SettingsController::class, 'index'])->name('student-settings');
	Route::get('settings/password',[SettingsController::class, 'password'])->name('student-settings-password');
	Route::get('settings/huvaari',[SettingsController::class, 'huvaari'])->name('student-settings-huvaari');
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

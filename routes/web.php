<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return redirect()->route('dashboard');
});

Route::get('/home', function () {
    return Inertia::render('Home', [
    ]);
})->name('home');

Route::get('/student/create', function () {
    return Inertia::render('Student/Add', [
    ]);
})->name('student.create');

Route::get('/users/credentials',  [\App\Http\Controllers\AdminController::class,'userCredentials'])->name('user.credentials');
Route::patch('/users/credentials',  [\App\Http\Controllers\AdminController::class,'updateUserCredentials'])->name('user.update');

Route::get('/academic-years',  [\App\Http\Controllers\AdminController::class,'indexAcademicYear'])->name('academicYear.index');
Route::get('/academic-years/create', [\App\Http\Controllers\AdminController::class,'createAcademicYear'])->name('academicYear.create');
Route::post('/academic-years/create', [\App\Http\Controllers\AdminController::class,'storeAcademicYear'])->name('academicYear.store');
Route::post('/academic-years/change-current', [\App\Http\Controllers\AdminController::class,'changeCurrentAcademicYear'])->name('academicYear.change-current');

Route::get('/subjects',  [\App\Http\Controllers\AdminController::class,'indexSubjects'])->name('subject.index');
Route::get('/subjects/add',  [\App\Http\Controllers\AdminController::class,'addSubject'])->name('subject.add');
Route::post('/subjects/add',  [\App\Http\Controllers\AdminController::class,'storeSubject'])->name('subject.store');
Route::get('/subjects/edit',  [\App\Http\Controllers\AdminController::class,'editSubject'])->name('subject.edit');
Route::patch('/subjects/edit',  [\App\Http\Controllers\AdminController::class,'patchSubject'])->name('subject.patch');

Route::get('/classes',  [\App\Http\Controllers\AdminController::class,'indexClass'])->name('class.index');
Route::get('/classes/add',  [\App\Http\Controllers\AdminController::class,'addClass'])->name('class.add');
Route::post('/classes/add',  [\App\Http\Controllers\AdminController::class,'storeClass'])->name('class.store');
Route::get('/classes/edit',  [\App\Http\Controllers\AdminController::class,'editClass'])->name('class.edit');
Route::patch('/classes/edit',  [\App\Http\Controllers\AdminController::class,'patchClass'])->name('class.patch');

Route::get('/students',  [\App\Http\Controllers\AdminController::class,'indexStudent'])->name('student.index');
Route::get('/students/add',  [\App\Http\Controllers\AdminController::class,'addStudent'])->name('student.add');
Route::post('/students/add',  [\App\Http\Controllers\AdminController::class,'storeStudent'])->name('student.store');
Route::get('/students/edit',  [\App\Http\Controllers\AdminController::class,'editStudent'])->name('student.edit');
Route::patch('/students/edit',  [\App\Http\Controllers\AdminController::class,'updateStudent'])->name('student.update');

Route::get('/teachers',  [\App\Http\Controllers\AdminController::class,'indexTeacher'])
    ->name('teacher.index');
Route::get('/teachers/add',  [\App\Http\Controllers\AdminController::class,'addTeacher'])
    ->name('teacher.add');
Route::post('/teachers/add',  [\App\Http\Controllers\AdminController::class,'storeTeacher'])
    ->name('teacher.store');
Route::get('/teachers/edit',  [\App\Http\Controllers\AdminController::class,'editTeacher'])
    ->name('teacher.edit');
Route::post('/teachers/edit',  [\App\Http\Controllers\AdminController::class,'updateTeacher'])
    ->name('teacher.patch');

Route::get('/school-certificate/tempalte',  [\App\Http\Controllers\AdminController::class,'editSchoolCertificate'])
    ->name('school-certificate.edit');
Route::post('/school-certificate/template',  [\App\Http\Controllers\AdminController::class,'updateSchoolCertificate'])
    ->name('school-certificate.update');
Route::get('/school-certificate/request',  [\App\Http\Controllers\StudentController::class,'requestCertifciate'])
    ->name('school-certificate.request');

Route::get('/school-certificate/download',  [\App\Http\Controllers\StudentController::class,'downloadSchoolCertificate'])
    ->name('school-certificate.download');

Route::get('/teachers-classes',  [\App\Http\Controllers\AdminController::class,'indexTeachersClasses'])
    ->name('teacher-class.index');
Route::get('/teachers-classes/update-class-teachers',  [\App\Http\Controllers\AdminController::class,'updateTeachersClasses'])
    ->name('teacher-class.update');
Route::post('/teachers-classes/update-class-teachers',  [\App\Http\Controllers\AdminController::class,'storeUpdateTeachersClasses'])
    ->name('teacher-class.storeUpdate');

Route::get('/exams',  [\App\Http\Controllers\AdminController::class,'indexExam'])
    ->name('exam.index');
Route::post('/exams',  [\App\Http\Controllers\AdminController::class,'updateExam'])
    ->name('exam.update');

Route::get('/login-as',  [\App\Http\Controllers\AdminController::class,'loginAs'])
    ->name('login_as');

Route::get('/teacher/exams',  [\App\Http\Controllers\TeacherController::class,'indexExam'])
    ->name('teacher.exam-notes');
Route::post('/teacher/exams/update-notes',  [\App\Http\Controllers\TeacherController::class,'updateExamNotes'])
    ->name('teacher.update-exam-notes');

Route::get('/exams/student-notes',  [\App\Http\Controllers\StudentController::class,'examNotes'])
    ->name('student.exams-notes');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');

Route::get('/login',  [\App\Http\Controllers\AuthController::class,'login'])->name('login');


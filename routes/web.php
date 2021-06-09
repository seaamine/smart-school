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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/home', function () {
    return Inertia::render('Home', [
    ]);
})->name('home');

Route::get('/student/create', function () {
    return Inertia::render('Student/Add', [
    ]);
})->name('student.create');

Route::get('/academic-years',  [\App\Http\Controllers\AdminController::class,'indexAcademicYear'])->name('academicYear.index');
Route::get('/academic-years/create', [\App\Http\Controllers\AdminController::class,'createAcademicYear'])->name('academicYear.create');
Route::post('/academic-years/create', [\App\Http\Controllers\AdminController::class,'storeAcademicYear'])->name('academicYear.store');

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

Route::get('/teachers',  [\App\Http\Controllers\AdminController::class,'indexTeacher'])
    ->name('teacher.index')->middleware('auth');;
Route::get('/teachers/add',  [\App\Http\Controllers\AdminController::class,'addTeacher'])
    ->name('teacher.add')->middleware('auth');;
Route::post('/teachers/add',  [\App\Http\Controllers\AdminController::class,'storeTeacher'])
    ->name('teacher.store')->middleware('auth');;

Route::get('/teachers-classes',  [\App\Http\Controllers\AdminController::class,'indexTeachersClasses'])
    ->name('teacher-class.index')->middleware('auth');
Route::get('/teachers-classes/update-class-teachers',  [\App\Http\Controllers\AdminController::class,'updateTeachersClasses'])
    ->name('teacher-class.update')->middleware('auth');
Route::post('/teachers-classes/update-class-teachers',  [\App\Http\Controllers\AdminController::class,'storeUpdateTeachersClasses'])
    ->name('teacher-class.storeUpdate')->middleware('auth');

Route::get('/Exams',  [\App\Http\Controllers\AdminController::class,'indexExam'])
    ->name('exam.index')->middleware('auth');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');

Route::get('/login',  [\App\Http\Controllers\AuthController::class,'login'])->name('login');


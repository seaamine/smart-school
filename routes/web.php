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


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');

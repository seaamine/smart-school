<?php

namespace App\Http\Controllers;


use App\Models\AcademicYear;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function indexAcademicYear(){
        $academicYears=AcademicYear::select('title','start_date','end_date')->get();
        return Inertia::render('AcademicYear/Index', ['yearsData'=>$academicYears
        ]);
    }
    //
    public function createAcademicYear(){
        return Inertia::render('AcademicYear/Add', []);
    }
    public function storeAcademicYear(Request $request)
    {
        $aYear = new AcademicYear;
        $aYear->title=$request->input('title');
        $aYear->start_date=$request->input('sdate');
        $aYear->end_date=$request->input('edate');
 /*       User::create(
            Request::validate([
                'first_name' => ['required', 'max:50'],
                'last_name' => ['required', 'max:50'],
                'email' => ['required', 'max:50', 'email'],
            ])
        );*/
        $aYear->save();
        return Redirect::route('home');
    }

    public function indexSubjects(){
        $subjects= Subject::all();
        return Inertia::render('subject/Index', ['subjects'=>$subjects
        ]);
    }
    public function addSubject(){
        return Inertia::render('subject/Add', []);
    }
}

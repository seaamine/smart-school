<?php

namespace App\Http\Controllers;

use App\Helpers\AppHelper;
use App\Models\Exam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class TeacherController extends Controller
{
    //
    public function indexExam(){
        $academicYear= AppHelper::getAcademicYear();
        $count = DB::table('classes')
            ->join('subjects',function ($join) {
                $join->on('subjects.level', 'like',DB::raw("CONCAT('%', classes.level, '%')"))
                    ->where('subjects.status','=','1')
                    ->whereNull('subjects.deleted_at');
            })
            ->count();
        if(!isset($academicYear)){
            session()->flash("toast",['type'=>'error', 'summary'=>'L\'opération a échoué!','detail' => 'L\'année académique n\'est pas encore fixée! Veuillez aller dans les paramètres et le définir.']);
            return redirect()->route('exam.index');
        }
        $exams=Exam::where('academic_year_id',$academicYear->id)->get();
        return Inertia::render('Exam/EditNotes', ['totalNotes'=>$count,'exams'=>$exams,'academicYear'=>$academicYear]);

    }
}

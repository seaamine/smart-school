<?php

namespace App\Http\Controllers;

use App\Helpers\AppHelper;
use App\Models\Exam;
use App\Models\SClass;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\TeacherClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            return redirect()->route('teacher.exam-notes');
        }
        $teacher = Teacher::where('user_id',Auth::id())->first();
        if(!isset($teacher)){
            session()->flash("toast",['type'=>'error', 'summary'=>'L\'opération a échoué!','detail' => 'Error cant find teatcher information in database']);
            return redirect()->route('teacher.exam-notes');
        }
        $exams=Exam::where('academic_year_id',$academicYear->id)->get();
        $classes=DB::table('classes')
            ->join('teacher_class',function($join) use($teacher,$academicYear){
                $join->on('classes.id','=','teacher_class.class_id')
                    ->whereNull('teacher_class.deleted_at')
                    ->where('teacher_class.teacher_id','=',$teacher->id)
                    ->where('teacher_class.academic_year_id','=',$academicYear->id);
                })
            ->where('classes.status','1')
            ->whereNull('classes.deleted_at')
            ->select('classes.*')
            ->get();
        $subjects=Subject::where('status','=','1')->get();
        $levelsSubjects=[];
        foreach ($subjects as $subject) {
            if(strpos($subject->level, '1') !== false){
                $levelsSubjects[1][$subject->id]=$subject;
            }
            if(strpos($subject->level, '2') !== false){
                $levelsSubjects[2][$subject->id]=$subject;
            }
            if(strpos($subject->level, '3') !== false){
                $levelsSubjects[3][$subject->id]=$subject;
            }
            if(strpos($subject->level, '4') !== false){
                $levelsSubjects[4][$subject->id]=$subject;
            }
        }
        //dd($classes,$levelsSubjects);
        return Inertia::render('Exam/EditNotes',
            ['levelsSubjects'=>$levelsSubjects,'classes'=>$classes->groupBy('level'),'totalNotes'=>$count,'exams'=>$exams,'academicYear'=>$academicYear]);

    }
}

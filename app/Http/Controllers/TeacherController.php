<?php

namespace App\Http\Controllers;

use App\Helpers\AppHelper;
use App\Models\Exam;
use App\Models\SClass;
use App\Models\Student;
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
        $subject=$teacher->subject;
        $classesStudents=[];
        foreach ($classes as $class){
            $classesStudents[$class->id]=Student::join('registrations',function($join) use($academicYear,$class){
                $join->on('students.id','=','registrations.student_id')
                    ->where('registrations.academic_year_id','=',$academicYear->id)
                    ->where('registrations.class_id','=',$class->id)
                    ->where('registrations.status','1');})
                ->leftJoin('exams_notes',function($join) use($academicYear,$class,$teacher,$subject){
                    $join->on('students.id','=','exams_notes.student_id')
                        ->where('exams_notes.academic_year_id','=',$academicYear->id)
                        ->where('exams_notes.class_id','=',$class->id)
                        ->where('exams_notes.subject_id','=',$subject->id)
                        ->where('exams_notes.teacher_id',$teacher->id);})
                ->select('students.*','exams_notes.id as note_id','exams_notes.note_eval','exams_notes.note_devoir','exams_notes.note_exam','exams_notes.remarque')
                ->get();
        }
        //dd($classesStudents,$subject,$classes,$levelsSubjects,$teacher);
        return Inertia::render('Exam/EditNotes',
            ['classesStudents'=>$classesStudents,'subject'=>$subject,'classes'=>$classes->groupBy('level'),'totalNotes'=>$count,'exams'=>$exams,'academicYear'=>$academicYear]);

    }
}

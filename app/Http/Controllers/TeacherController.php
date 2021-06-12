<?php

namespace App\Http\Controllers;

use App\Helpers\AppHelper;
use App\Models\Exam;
use App\Models\ExamNote;
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
                ->select('students.*','registrations.regi_no','exams_notes.id as note_id','exams_notes.note_eval','exams_notes.note_devoir','exams_notes.note_exam','exams_notes.remarque')
                ->get();
        }
        //dd($classesStudents,$subject,$classes,$levelsSubjects,$teacher);
        return Inertia::render('Exam/EditNotes',
            ['classesStudents'=>$classesStudents,'subject'=>$subject,'classes'=>$classes->groupBy('level'),'totalNotes'=>$count,'exams'=>$exams,'academicYear'=>$academicYear]);

    }
    public function updateExamNotes(Request $request){
        $academicYear= AppHelper::getAcademicYear();
        if(!isset($academicYear)){
            session()->flash("toast",['type'=>'error', 'summary'=>'L\'opération a échoué!','detail' => 'L\'année académique n\'est pas encore fixée! Veuillez aller dans les paramètres et le définir.']);
            return redirect()->route('exam.index');
        }
        $validated = $request->validate([
            'trimester' => 'required|in:1,2,3',
            'academicYear' => 'required|in:'.$academicYear->id,
            'class' => 'required',
            'exam' => 'required',
            'examNotes' => 'required',
            'examNotes.*.note_eval' => 'required|numeric|min:0|max:20',
            'examNotes.*.note_devoir' => 'required|numeric|min:0|max:20',
            'examNotes.*.note_exam' => 'required|numeric|min:0|max:20',
            'examNotes.*.note' => 'required'
        ]);
        $user = Auth::user();
        $teacher =  Teacher::where('status','1')->where('user_id',$user->id)->first();
        $exam =Exam::where('status','1')->where('trimester',$request->input('trimester'))->where('id',$request->input('id'))
            ->where('academic_year_id',$academicYear->id)->first();
        if(!isset($exam) | $exam->started_at === null | $exam->stopped_at !== null){

        }
        $table->unsignedInteger('student_id')->nullable();
        $table->unsignedInteger('teacher_id')->nullable();
        $table->double('note_eval');
        $table->double('note_devoir');
        $table->double('note_exam');
        $table->string('remarque');
        $examNotes=[];
        foreach ($request->input('examNotes') as $studentNote){
            $examNotes[]=['academic_year_id'=>$academicYear->id,'exam_id'=>$exam->id,'trimester'=>$exam->trimester,
                'class_id'=>$request->input('class'),'subject_id'=>$request->input('class'),];
        }
        ExamNote::upsert();

    }
}

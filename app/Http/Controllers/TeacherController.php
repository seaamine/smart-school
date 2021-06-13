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
        $count = $classes->count();
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
        $teacherSubject=$teacher->subject;
        $classesStudents=[];
        $examsCount=[];
        $examsCompleted=[];
        foreach ($exams as $key=>$exam){
           $examsCount[$exam->id]['num_class_completed'] = 0;
        }
        foreach ($classes as $class){
            $students=Student::join('registrations',function($join) use($academicYear,$class){
                $join->on('students.id','=','registrations.student_id')
                    ->where('registrations.academic_year_id','=',$academicYear->id)
                    ->where('registrations.class_id','=',$class->id)
                    ->where('registrations.status','1')
                    ->whereNull('registrations.deleted_at')
                ;})
                ->leftJoin('exams_notes',function($join) use($academicYear,$class,$teacher,$teacherSubject){
                    $join->on('students.id','=','exams_notes.student_id')
                        ->where('exams_notes.academic_year_id','=',$academicYear->id)
                        ->where('exams_notes.class_id','=',$class->id)
                        ->where('exams_notes.subject_id','=',$teacherSubject->id)
                        ->where('exams_notes.teacher_id',$teacher->id)
                        ->whereNull('exams_notes.deleted_at');})
                ->select('students.*','registrations.group','registrations.regi_no','exams_notes.trimester','exams_notes.exam_id','exams_notes.id as note_id','exams_notes.note_eval','exams_notes.note_devoir','exams_notes.note_exam','exams_notes.remarque')
                ->get();
            foreach ($students as $student){
                if($student->trimester === '2' && $student->exam_id == null){
                    dd($student,"level 2");
                };
                if(!isset($classesStudents[$class->id][$student->id])){
                    $classesStudents[$class->id][$student->id]=[
                        'id'=>$student->id,
                        'first_name'=>$student->first_name,
                        'last_name'=>$student->last_name,
                        'group' => $student->group,
                        'regi_no' => $student->regi_no,
                        'exams'=>[],
                    ];
                }
                if(isset($student->exam_id)){
                    if(!isset($examsCompleted[$student->exam_id][$class->id])){
                        $examsCompleted[$student->exam_id][$class->id] = true;
                        $examsCount[$student->exam_id]['num_class_completed']++;
                    }
                    $classesStudents[$class->id][$student->id]['exams'][$student->trimester]=[
                        'exams_notes.exam_id' => $student->exam_id,
                        'note_id' => $student->note_id,
                        'note_eval' => $student->note_eval,
                        'note_devoir' =>$student->note_devoir,
                        'note_exam'=>$student->note_exam,
                        'remarque' => $student->remarque,
                    ];
                }else{
                }
            }


        }
        return Inertia::render('Exam/EditNotes',
            ['examsCount'=>$examsCount,'classesStudents'=>$classesStudents,'subject'=>$subject,'classes'=>$classes->groupBy('level'),'totalNotes'=>$count,'exams'=>$exams,'academicYear'=>$academicYear]);

    }
    public function updateExamNotes(Request $request){
        $academicYear= AppHelper::getAcademicYear();
        if(!isset($academicYear)){

            return response()->json([
                'toast' => ['type'=>'error', 'summary'=>'L\'opération a échoué!','detail' => 'L\'année académique n\'est pas encore fixée! Veuillez aller dans les paramètres et le définir.'],
                'type' => 'error',
            ]);
        }
        $validated = $request->validate([
            'trimester' => 'required|in:1,2,3',
            'academicYear' => 'required|in:'.$academicYear->id,
            'class' => 'required',
            'exam' => 'required',
            'examNotes' => 'required',
            'examNotes.*.student_id' => 'required',
            'examNotes.*.note_eval' => 'required|numeric|min:0|max:20',
            'examNotes.*.note_devoir' => 'required|numeric|min:0|max:20',
            'examNotes.*.note_exam' => 'required|numeric|min:0|max:20',
            'examNotes.*.remarque' => 'required'
        ]);
        $user = Auth::user();
        $teacher =  Teacher::where('status','1')->where('user_id',$user->id)->first();
        $exam =Exam::where('status','1')->where('trimester',$request->input('trimester'))->where('id',$request->input('exam'))
            ->where('academic_year_id',$academicYear->id)->first();
        if(!isset($exam) || $exam->started_at === null || $exam->stopped_at !== null){
            return response()->json([
                'toast' => ['type'=>'error', 'summary'=>'L\'opération a échoué!','detail' => "notes soumettre à l'examen du trimestre $exam->trimester n'est pas autorisé, s'il vous plaît vérifier avec l'administration."],
                'type' => 'error',
            ]);
        }
        $class = SClass::where('status','1')->where('id',$request->input('class'))->first();
        if(!$class){
            return response()->json([
                'toast' => ['type'=>'error', 'summary'=>'L\'opération a échoué!','detail' => "Nous n'avons pas pu trouver cette classe."],
                'type' => 'error',
            ]);
        }
        $examNotes=[];
        $countExisting=0;
        $countd=0;
        foreach ($request->input('examNotes') as $studentNote){
            $sNote = ExamNote::where('academic_year_id',$academicYear->id)
                ->where('exam_id',$exam->id)->where('trimester',$request->input('trimester'))
                ->where('subject_id',$teacher->subject_id)
                ->where('student_id',$studentNote['student_id'])->first();
            if($sNote){
                $countExisting++;
                if($sNote->teacher_id !== $teacher->id || $sNote->class_id !== $request->input('class')){
                    $sNote->delete();
                    $countd++;
                    ExamNote::create([
                        'academic_year_id'=>$academicYear->id,'exam_id'=>$exam->id,'trimester'=>$exam->trimester,
                        'class_id'=> $request->input('class'),'subject_id'=>$teacher->subject_id,
                        'student_id'=> $studentNote['student_id'],
                        'teacher_id'=> $teacher->id,
                        'note_eval' => $studentNote['note_eval'],
                        'note_devoir' => $studentNote['note_devoir'],
                        'note_exam' => $studentNote['note_exam'],
                        'remarque' => $studentNote['remarque']]);

                }else{
                    $sNote->note_eval = $studentNote['note_eval'];
                    $sNote->note_devoir = $studentNote['note_devoir'];
                    $sNote->note_exam = $studentNote['note_exam'];
                    $sNote->remarque = $studentNote['remarque'];
                    $sNote->save();
                }
            }else{
                ExamNote::create([
                    'academic_year_id'=>$academicYear->id,'exam_id'=>$exam->id,'trimester'=>$exam->trimester,
                    'class_id'=>$request->input('class'),'subject_id'=>$teacher->subject_id,'student_id'=>$studentNote['student_id'],
                    'teacher_id'=>$teacher->id,
                    'note_eval' =>$studentNote['note_eval'],
                    'note_devoir' =>$studentNote['note_devoir'],
                    'note_exam' =>$studentNote['note_exam'],
                    'remarque' =>$studentNote['remarque']
                ]);
            }
           }
        if($countExisting === 0){
            Exam::find($exam->id)->increment('num_notes', 1);
        }
        //$exNotes=ExamNote::upsert($examNotes,['id'],['note_exam','note_eval','note_exam','remarque','teacher_id']);
        return response()->json([
            'toast' => ['type'=>'success', 'summary'=>'l\'opération a réussi!','detail' => "les notes de la classe $class->name pour le trimestre $exam->trimester ont été soumises avec succès."],
            'type' => 'success',
        ]);
    }
}

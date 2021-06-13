<?php

namespace Database\Seeders;

use App\Helpers\AppHelper;
use App\Models\Exam;
use App\Models\ExamNote;
use App\Models\Registration;
use App\Models\SClass;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Database\Seeder;

class ExamNotesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $academicYear= AppHelper::getAcademicYear();
        $exam = Exam::where('trimester','1')
            ->where('academic_year_id',$academicYear->id)->where('status','1')->first();
        $students=Registration::where('academic_year_id',$academicYear->id)
            ->where('status','1')->orderBy('class_id')->get();
        $subjects = Subject::where('status','1')->get();
        $count=[
            1=>['classes'=>0,'subjects'=>0],
            2=>['classes'=>0,'subjects'=>0],
            3=>['classes'=>0,'subjects'=>0],
            4=>['classes'=>0,'subjects'=>0],
        ];
        $currentClass=0;
        foreach ($subjects as $subject) {
            for ($i = 1; $i < 5; $i++) {
                if (strpos($subject->level, "$i") !== false) {
                    $count[$i]['subjects']++;
                }
            }
        }
        foreach ($students as $student){
            $class= SClass::where('id',$student->class_id)->first();
            if($currentClass !== $class->id) {
                $currentClass = $class->id;
                $count[$class->level]['classes']++;
            }
            foreach ($subjects as $subject){
                    $teacher = Teacher::join('teacher_class','teacher_class.teacher_id','=','teachers.id')
                        ->where('teacher_class.class_id',$class->id)
                        ->where('teacher_class.subject_id',$subject->id)
                        ->where('teacher_class.academic_year_id',$academicYear->id)
                        ->select('teachers.*')
                        ->first();
                    if($class->id === 10){
                    }
                    ExamNote::create(['academic_year_id'=>$academicYear->id,
                        'exam_id'=>$exam->id,
                        'trimester'=>$exam->trimester,'class_id'=>$class->id,
                        'student_id'=>$student->student_id, 'subject_id'=> $subject->id,
                        'teacher_id'=>$teacher->id,'note_eval'=>rand(5,20),
                        'note_devoir'=>rand(5,20),'note_exam'=>rand(5,20),
                        'remarque'=>'bien'
                    ]);

            }

        }
        $exam->num_notes=$count[1]['subjects']*$count[1]['classes']+$count[2]['subjects']*$count[2]['classes']+
            $count[3]['subjects']*$count[3]['classes']+$count[4]['subjects']*$count[4]['classes'];
        $exam->save();
        //
    }
}

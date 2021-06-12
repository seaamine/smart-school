<?php

namespace Database\Seeders;

use App\Helpers\AppHelper;
use App\Models\SClass;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\TeacherClass;
use Illuminate\Database\Seeder;

class TeachersClassesSedder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $academicYear = AppHelper::getAcademicYear();
        $subjects = Subject::where('status','1')->get();
        $classes = SClass::where('status','1')->get();
        $classes= $classes->groupBy('level');
        foreach ($subjects as $subject){
            $teachers = Teacher::where('status','1')->where('subject_id',$subject->id)->get();
            foreach($classes as $level=>$classesLevel){
                if(strpos($subject->level, ''.$level) !== false){
                    if($level === 1){
                        foreach ($classesLevel as $key=>$classe){
                            if($key < count($classesLevel)/2){
                                TeacherClass::create(['teacher_id'=>$teachers[0]->id,'class_id'=>$classe->id,'subject_id'=>$subject->id,'academic_year_id'=>$academicYear->id,'status'=>'1']);
                            }else{
                                TeacherClass::create(['teacher_id'=>$teachers[1]->id,'class_id'=>$classe->id,'subject_id'=>$subject->id,'academic_year_id'=>$academicYear->id,'status'=>'1']);
                            }
                        }
                    }elseif ($level === 2){
                        foreach ($classesLevel as $key=>$classe){
                            if($key < count($classesLevel)/2){
                                TeacherClass::create(['teacher_id'=>$teachers[2]->id,'class_id'=>$classe->id,'subject_id'=>$subject->id,'academic_year_id'=>$academicYear->id,'status'=>'1']);
                            }else{
                                TeacherClass::create(['teacher_id'=>$teachers[3]->id,'class_id'=>$classe->id,'subject_id'=>$subject->id,'academic_year_id'=>$academicYear->id,'status'=>'1']);
                            }
                        }
                    }elseif ($level === 3){
                        foreach ($classesLevel as $key=>$classe){
                            if($key < count($classesLevel)/2){
                                TeacherClass::create(['teacher_id'=>$teachers[0]->id,'class_id'=>$classe->id,'subject_id'=>$subject->id,'academic_year_id'=>$academicYear->id,'status'=>'1']);
                            }else{
                                TeacherClass::create(['teacher_id'=>$teachers[1]->id,'class_id'=>$classe->id,'subject_id'=>$subject->id,'academic_year_id'=>$academicYear->id,'status'=>'1']);
                            }
                        }
                    }elseif ($level === 4){
                        foreach ($classesLevel as $key=>$classe){
                            if($key < count($classesLevel)/2){
                                TeacherClass::create(['teacher_id'=>$teachers[2]->id,'class_id'=>$classe->id,'subject_id'=>$subject->id,'academic_year_id'=>$academicYear->id,'status'=>'1']);
                            }else{
                                TeacherClass::create(['teacher_id'=>$teachers[3
                                ]->id,'class_id'=>$classe->id,'subject_id'=>$subject->id,'academic_year_id'=>$academicYear->id,'status'=>'1']);
                            }
                        }
                    }

                }
            }
        }
        //
    }
}

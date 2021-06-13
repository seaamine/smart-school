<?php

namespace Database\Seeders;

use App\Helpers\AppHelper;
use App\Models\Exam;
use Illuminate\Database\Seeder;

class ExamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $academicYear= AppHelper::getAcademicYear();
        Exam::create(['trimester'=>'1','academic_year_id'=>$academicYear->id,
            'started_at'=>now(),'stopped_at'=>now(),
            'status'=>'1']);
        //
    }
}

<?php

namespace Database\Seeders;

use App\Models\AcademicYear;
use Illuminate\Database\Seeder;

class AcademicYearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AcademicYear::create(
            ['is_open_for_admission'=>'1','title'=>'2020-2021','start_date'=>'2020-09-02','end_date'=>'2021-07-15','status'=>'1']
        );
    }
}

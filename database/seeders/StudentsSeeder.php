<?php

namespace Database\Seeders;

use App\Helpers\AppHelper;
use App\Models\Registration;
use App\Models\SClass;
use App\Models\Student;
use Illuminate\Database\Seeder;
use App\Models\Teacher;
use App\Models\User;
use Faker\Factory;

class StudentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        $classes=SClass::where('status',1)->get();
        $currentAYear=AppHelper::getAcademicYear();
        foreach ($classes as $classe){
            for($i=0;$i<40;$i++){
                $genderArray=['male','female'];
                $gender=$genderArray[array_rand($genderArray)];
                $genderTog=['male'=>'m','female'=>'f'];
                $first_name=$faker->firstName($gender);
                $last_name=$faker->lastName($gender);
                $email=$faker->unique()->email;
                $user=User::create(['email'=>$email,'name'=>"$last_name $first_name",'status'=>'1','username'=>$faker->unique()->userName,'password'=>bcrypt('123456'),'gender'=>$genderTog[$gender],'role'=>'student']);
                $student=Student::create(['user_id'=>$user->id,'status'=>'1','first_name'=>$first_name, 'last_name'=>$last_name,
                    'commune'=>'alger','willaya'=>'Alger','paye'=>'Algeria',
                    'dob'=>$faker->date($format = 'Y-m-d', $max = 'now'),'gender'=>$genderTog[$gender],
                    'email'=>$email,
                    'photo'=>$faker->imageUrl(),
                    'father_name'=>$faker->firstName('male'),'mother_full_name'=>"$faker->lastName('female') $faker->firstName('female')",
                    'father_phone_no'=>$faker->e164PhoneNumber,'mother_phone_no'=>$faker->e164PhoneNumber,
                ]);
                $regiNo = $currentAYear->start_date->format('y') . (string)$classe->name;
                $totalStudent = Registration::where('academic_year_id', $currentAYear->id)
                    ->where('class_id', $classe->id)->withTrashed()->count();
                $regiNo .= str_pad(++$totalStudent,3,'0',STR_PAD_LEFT);
                Registration::create([
                    'regi_no'=>$regiNo,
                    'student_id'=>$student->id,'level'=>$classe->level,'class_id'=>$classe->id,'status'=>'1',
                    'group'=>($i < 20)? 1:2, 'academic_year_id'=>$currentAYear->id
                ]);
            }
        }
    }
}

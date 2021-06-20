<?php


namespace Database\Seeders;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TeachersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('ar_SA');
        $subjects = Subject::where('status','1')->get();
        foreach ($subjects as $subject){
            for($i=0;$i<4;$i++){
                $genderArray=['male','female'];
                $qualificationArray=['B','M','L'];
                $gender=$genderArray[array_rand($genderArray)];
                $genderTog=['male'=>'m','female'=>'f'];
                $first_name=$faker->firstName($gender);
                $last_name=$faker->lastName($gender);
                $email=$faker->unique()->email;
                $email = substr_replace($email, rand(0,100).'', strpos($email,'@'), 0);
                $user=User::create(['email'=>$email,'name'=>"$last_name $first_name",'status'=>'1','username'=>$faker->unique()->userName.'_'.str::random(3),'password'=>bcrypt('123456'),'gender'=>$genderTog[$gender],'role'=>'teacher']);
                Teacher::create(['user_id'=>$user->id,'subject_id'=>$subject->id,'status'=>'1','first_name'=>$first_name, 'last_name'=>$last_name,
                    'commune'=>'alger','willaya'=>'Alger','paye'=>'Algeria', 'qualification'=>$qualificationArray[array_rand($qualificationArray)],
                    'dob'=>$faker->date($format = 'Y-m-d', $max = 'now'),'gender'=>$genderTog[$gender],
                    'email'=>$email,'joining_date'=>$faker->date($format = 'Y-m-d', $max = 'now'),
                    'photo'=>$faker->imageUrl(),
                ]);

            }
        }
    }
}

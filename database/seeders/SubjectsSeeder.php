<?php


namespace Database\Seeders;


use Illuminate\Database\Seeder;
use App\Models\Subject;

class SubjectsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Subject::create(['name'=>'Histoire','status'=>1,'image_path'=>'images/history.jpg']);
        Subject::create(['name'=>'Géographie','status'=>1]);
        Subject::create(['name'=>'Education Islamique','status'=>1]);
        Subject::create(['name'=>'Education Civique','status'=>1]);
        Subject::create(['name'=>'Mathématiques','status'=>1,'image_path'=>'images/math.jpg']);
        Subject::create(['name'=>'Sciences de la nature et de la vie','status'=>1,'image_path'=>'images/biology.jpg']);
        Subject::create(['name'=>'Sciences physiques et technologiques','status'=>1,'image_path'=>'images/physics.jpg']);
        Subject::create(['name'=>'Langue arabe','status'=>1]);
        Subject::create(['name'=>'Langue Tamazight','status'=>1]);
        Subject::create(['name'=>'langue française','status'=>1]);
        Subject::create(['name'=>'langue anglaise','status'=>1]);


    }
}

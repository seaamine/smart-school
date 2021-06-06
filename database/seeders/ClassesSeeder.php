<?php

namespace Database\Seeders;

use App\Models\SClass;
use Illuminate\Database\Seeder;

class ClassesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $level = 1;
        for ($i = 1 ; $i<=4 ;$i++){
            for($j = 1 ; $j<=6 ;$j++){
                SClass::create(['name'=>"{$i}AM{$j}",'level'=>$i,'groups'=>"2","status"=>'1']);
            }
        }
        //
    }
}

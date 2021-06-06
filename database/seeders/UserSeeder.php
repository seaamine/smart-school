<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(['email'=>'aymen@gmail.com','name'=>'Laamari Aymen','status'=>'1','username'=>'admin','password'=>bcrypt('123456'),'gender'=>'m','role'=>'admin']);
    }
}

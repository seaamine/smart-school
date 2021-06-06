<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(AcademicYearSeeder::class);
        $this->call(SubjectsSeeder::class);
        $this->call(ClassesSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(TeachersSeeder::class);
        $this->call(StudentsSeeder::class);
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registrations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('regi_no',20);
            $table->unsignedInteger('student_id');
            $table->enum('level', [1,2,3,4])->default(1);
            $table->unsignedInteger('class_id');
            $table->unsignedTinyInteger('group')->default(1);
            $table->unsignedInteger('academic_year_id');
            $table->enum('status', [0,1])->default(1);
            $table->enum('is_promoted', [0,1])->default(0);
            $table->unsignedInteger('old_registration_id')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('student_id')->references('id')->on('students');
            $table->foreign('class_id')->references('id')->on('classes');
            $table->foreign('academic_year_id')->references('id')->on('academic_years');
            //$table->foreign('old_registration_id')->references('id')->on('registrations');
            $table->index('regi_no');
        });

    }
    public function student()
    {
        return $this->belongsTo('App\Models\Student', 'student_id');
    }
    public function class()
    {
        return $this->belongsTo('App\Models\SClass', 'class_id');
    }
    public function acYear()
    {
        return $this->belongsTo('App\Models\AcademicYear', 'academic_year_id');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registrations');
    }
}

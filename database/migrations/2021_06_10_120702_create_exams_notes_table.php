<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamsNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exams_notes', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('academic_year_id')->nullable();
            $table->unsignedInteger('exam_id')->nullable();
            $table->enum('semester', [1,2,3])->default('1');
            $table->unsignedInteger('class_id')->nullable();
            $table->unsignedInteger('subject_id')->nullable();
            $table->unsignedInteger('student_id')->nullable();
            $table->unsignedInteger('teacher_id')->nullable();
            $table->double('note_eval');
            $table->double('note_devoir');
            $table->double('note_exam');
            $table->string('remarque');
            //$table->enum('status', [0,1])->default('1');

            $table->foreign('academic_year_id')->references('id')->on('academic_years');
            $table->foreign('exam_id')->references('id')->on('exams');
            $table->foreign('teacher_id')->references('id')->on('teachers');
            $table->foreign('student_id')->references('id')->on('students');
            $table->foreign('subject_id')->references('id')->on('subjects');
            $table->foreign('class_id')->references('id')->on('classes');

            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exams_notes');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeacherClassTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teacher_class', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('teacher_id')->nullable();
            $table->unsignedInteger('class_id')->nullable();
            $table->unsignedInteger('subject_id')->nullable();
            $table->unsignedInteger('academic_year_id')->nullable();
            $table->enum('status', [0,1])->default('1');

            $table->softDeletes();
            $table->timestamps();
            $table->foreign('teacher_id')->references('id')->on('teachers');
            $table->foreign('subject_id')->references('id')->on('subjects');
            $table->foreign('class_id')->references('id')->on('classes');
            $table->foreign('academic_year_id')->references('id')->on('academic_years');
            //$table->index(['class_id', 'subject_id','academic_year_id','deleted_at']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teacher_class');
    }
}

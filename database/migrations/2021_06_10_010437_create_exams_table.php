<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->enum('semester', [1,2,3])->default('1');
            $table->unsignedInteger('academic_year_id')->nullable();
            $table->enum('status', [0,1])->default('1');
            $table->timestamp('started_at')->nullable();
            $table->timestamp('stopped_at')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->unsignedTinyInteger('numbNotes')->default(0);
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('academic_year_id')->references('id')->on('academic_years');
            $table->unique(['semester','academic_year_id']);
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
        Schema::dropIfExists('exams');
    }
}

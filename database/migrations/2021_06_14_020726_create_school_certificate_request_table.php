<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchoolCertificateRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('school_certificate_request', function (Blueprint $table) {
            $table->increments('id');
            $table->string('certificate_no',20);
            $table->enum('level', [1,2,3,4])->default(1);
            $table->unsignedInteger('student_id');
            $table->unsignedInteger('class_id');
            $table->unsignedInteger('academic_year_id');
            $table->text('qr_code')->nullable();
            $table->string('regi_no',20);

            $table->softDeletes();
            $table->timestamps();
            $table->foreign('student_id')->references('id')->on('students');
            $table->foreign('class_id')->references('id')->on('classes');
            $table->foreign('academic_year_id')->references('id')->on('academic_years');
            //$table->foreign('old_registration_id')->references('id')->on('registrations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('school_certificate_request');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('subject_id')->nullable();

            $table->string('first_name');
            $table->string('last_name');
            $table->string('commune',50)->nullable();
            $table->string('willaya',50)->nullable();
            $table->string('paye',50)->nullable();
            $table->enum('qualification',['B','M','L'])->default('B');
            $table->date('dob');
            $table->enum('gender', ['f','m'])->default('m');
            $table->string('email',100)->nullable();
            $table->string('address',500)->nullable();
            $table->date('joining_date');
            $table->string('photo')->nullable();
            $table->enum('status', [0,1])->default(1);

            $table->timestamps();
            $table->softDeletes();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('subject_id')->references('id')->on('subjects');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teachers');
    }
}

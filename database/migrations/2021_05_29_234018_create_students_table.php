<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->date('dob');
            $table->enum('gender', ['f','m'])->default('m');
            $table->string('blood_group',10)->nullable();
            $table->string('commune',50)->nullable();
            $table->string('willaya',50)->nullable();
            $table->string('paye',50)->nullable();
            $table->string('photo')->nullable();
            $table->string('email',100)->nullable();
            $table->string('note',500)->nullable();
            $table->string('father_name')->nullable();
            $table->string('father_phone_no',15)->nullable();
            $table->string('mother_full_name')->nullable();
            $table->string('mother_phone_no',15)->nullable();
            $table->string('address',500)->nullable();
            $table->enum('status', [0,1])->default(1);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('user_id')->references('id')->on('users');

        });
    }
    public function registration()
    {
        return $this->hasMany('App\Models\Registration', 'student_id');
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserEducationInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_education_info', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('high_school_level')->nullable();
            $table->string('study_program')->nullable();
            $table->string('school_name')->nullable();
            $table->string('province')->nullable();
            $table->string('gpa')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_education_info');
    }
}

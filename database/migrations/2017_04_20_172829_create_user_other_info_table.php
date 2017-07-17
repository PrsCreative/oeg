<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserOtherInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_other_info', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('teacher_name')->nullable();
            $table->string('promotion_code')->nullable();
            $table->string('source_of_apply')->nullable();
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
        Schema::dropIfExists('users_other_info');
    }
}

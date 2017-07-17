<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserHighSchoolExchangeApplicationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_high_school_exchange_application', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('country_to_apply_1')->nullable();
            $table->string('country_to_apply_2')->nullable();
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
        Schema::dropIfExists('users_high_school_exchange_application');
    }
}

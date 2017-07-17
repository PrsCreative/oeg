<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserContactInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_contact_info', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('address_th')->nullable();
            $table->string('address_en')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('permanent_address_th')->nullable();
            $table->string('permanent_address_en')->nullable();
            $table->string('permanent_city')->nullable();
            $table->string('permanent_country')->nullable();
            $table->string('permanent_postal_code')->nullable();
            $table->string('emergency_contact_title')->nullable();
            $table->string('emergency_contact_name')->nullable();
            $table->string('emergency_contact_surname')->nullable();
            $table->string('emergency_contact_relationship')->default(0);
            $table->string('emergency_phone')->nullable();
            $table->string('emergency_email')->nullable();
            $table->string('emergency_address')->nullable();
            $table->string('emergency_city')->nullable();
            $table->string('emergency_country')->nullable();
            $table->string('emergency_postal_code')->nullable();
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
        Schema::dropIfExists('users_contact_info');
    }
}

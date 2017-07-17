<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNavBarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('nav_bar_template', function( Blueprint $table ) {
            $table->increments('id');
            $table->integer('order')->unique();
            $table->integer('show_in_state');
            $table->string('label',255);
            $table->string('route_name',255);
            $table->string('route_name_to_active',255);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('nav_bar_template');
    }
}

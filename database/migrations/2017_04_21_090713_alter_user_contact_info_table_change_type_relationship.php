<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUserContactInfoTableChangeTypeRelationship extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users_contact_info', function( Blueprint $table ) {
            $table->string('city')->nullable()->change();
            $table->string('country')->nullable()->change();
            $table->string('permanent_city')->nullable()->change();
            $table->string('permanent_country')->nullable()->change();
            $table->string('emergency_contact_relationship')->nullable()->change();
            $table->string('emergency_city')->nullable()->change();
            $table->string('emergency_country')->nullable()->change();
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
    }
}

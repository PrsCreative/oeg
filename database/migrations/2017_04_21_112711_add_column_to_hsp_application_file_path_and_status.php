<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnToHspApplicationFilePathAndStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users_high_school_exchange_application', function( Blueprint $table) {
            $table->longText('json_file_path')->after('country_to_apply_1')->nullable();
            $table->string('status')->after('country_to_apply_1')->default('pending');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}

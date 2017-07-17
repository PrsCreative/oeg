<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnToHighSchoolExchangeApplicationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('users_high_school_exchange_application', function( Blueprint $table ) {
            $table->string('admission_test_status')->after('admission_test_location_id')->nullable()->default('pending');
            $table->float('admission_test_score')->after('admission_test_status')->nullable();
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

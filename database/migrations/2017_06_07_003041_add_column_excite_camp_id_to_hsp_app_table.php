<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnExciteCampIdToHspAppTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users_high_school_exchange_application', function( Blueprint $table ) {
            $table->integer('excite_camp_id')->after('parent_location_amount')->nullable();
            $table->string('excite_camp_result')->after('excite_camp_id')->nullable();
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

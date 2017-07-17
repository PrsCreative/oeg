<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsAddressOrderToUserContactInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users_contact_info', function( Blueprint $table ) {
            $table->string('address_order_checkbox')->after('address_postcode')->nullable();
            $table->string('address_order_province')->after('address_order')->nullable();
            $table->string('address_order_postcode')->after('address_order_province')->nullable();
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

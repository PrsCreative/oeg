<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeColumnNameStudentInfoModule extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users_personal_info', function(Blueprint $table)
        {
            $table->renameColumn('firstnameEn', 'firstname_en');
            $table->renameColumn('lastnameEn', 'lastname_en');
            $table->renameColumn('nicknameEn', 'nickname_en');
            $table->renameColumn('phoneHome', 'phone_home');
            $table->renameColumn('provinceBorn', 'province_born');
            $table->renameColumn('countryBorn', 'country_born');
        });

        Schema::table('users_contact_info', function(Blueprint $table)
        {
            $table->renameColumn('addressParent','address_parent');
            $table->renameColumn('addressProvince','address_province');
            $table->renameColumn('addressPostCode','address_postcode');
            $table->renameColumn('addressOrder','address_order');
            $table->renameColumn('dadFirstName','dad_firstname');
            $table->renameColumn('dadLastName','dad_lastname');
            $table->renameColumn('dadAge','dad_age');
            $table->renameColumn('dadPhone','dad_phone');
            $table->renameColumn('dadEmail','dad_email');
            $table->renameColumn('dadJob','dad_job');
            $table->renameColumn('dadPosition','dad_position');
            $table->renameColumn('dadOffice','dad_office');
            $table->renameColumn('momFirstName','mom_firstname');
            $table->renameColumn('momLastName','mom_lastname');
            $table->renameColumn('momAge','mom_age');
            $table->renameColumn('momPhone','mom_phone');
            $table->renameColumn('momEmail','mom_email');
            $table->renameColumn('momJob','mom_job');
            $table->renameColumn('momPosition','mom_position');
            $table->renameColumn('momOffice','mom_office');
        });

        Schema::table('users_other_info', function( Blueprint $table ) {
            $table->renameColumn('disAdvantage','disadvantage');
            $table->renameColumn('socialMedia1','social_media1');
            $table->renameColumn('socialMedia2','social_media2');
            $table->renameColumn('socialMedia3','social_media3');
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

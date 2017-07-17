<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStudentInfoColumnToAllStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //personal info
        Schema::table('users_personal_info', function( Blueprint $table ) {
            $table->string('firstnameEn')->after('firstname')->nullable();
            $table->string('lastnameEn')->after('lastname')->nullable();
            $table->string('nicknameEn')->after('nickname')->nullable();
            $table->string('phoneHome')->after('phone')->nullable();
            $table->string('provinceBorn')->after('facebook')->nullable();
            $table->string('countryBorn')->after('provinceBorn')->nullable();
        });

        //contact info
        Schema::table('users_contact_info', function( Blueprint $table ) {
            $table->string('addressParent')->after('postal_code')->nullable();
            $table->string('addressProvince')->after('addressParent')->nullable();
            $table->string('addressPostCode')->after('addressProvince')->nullable();
            $table->string('addressOrder')->after('addressPostCode')->nullable();
            $table->string('dadFirstName')->after('emergency_postal_code')->nullable();
            $table->string('dadLastName')->after('dadFirstName')->nullable();
            $table->string('dadAge')->after('dadLastName')->nullable();
            $table->string('dadPhone')->after('dadAge')->nullable();
            $table->string('dadEmail')->after('dadPhone')->nullable();
            $table->string('dadJob')->after('dadEmail')->nullable();
            $table->string('dadPosition')->after('dadJob')->nullable();
            $table->string('dadOffice')->after('dadPosition')->nullable();
            $table->string('momFirstName')->after('dadPosition')->nullable();
            $table->string('momLastName')->after('momFirstName')->nullable();
            $table->string('momAge')->after('momLastName')->nullable();
            $table->string('momPhone')->after('momAge')->nullable();
            $table->string('momEmail')->after('momPhone')->nullable();
            $table->string('momJob')->after('momEmail')->nullable();
            $table->string('momPosition')->after('momJob')->nullable();
            $table->string('momOffice')->after('momPosition')->nullable();
        });

        //other info
        Schema::table('users_other_info', function( Blueprint $table ) {
            $table->string('has_join')->after('source_of_apply')->nullable();
            $table->string('has_parent')->after('has_join')->nullable();
            $table->string('has_experience')->after('has_parent')->nullable();
            $table->string('has_experience_with')->after('has_experience')->nullable();
            $table->string('has_experience_time')->after('has_experience_with')->nullable();
            $table->string('feel_to_black_human')->after('has_experience_time')->nullable();
            $table->string('feel_to_other_friend')->after('feel_to_black_human')->nullable();
            $table->string('personal_medical')->after('feel_to_other_friend')->nullable();
            $table->string('personal_medical_phoom')->after('personal_medical')->nullable();
            $table->string('personal_medical_drug')->after('personal_medical_phoom')->nullable();
            $table->string('personal_medical_animal')->after('personal_medical_drug')->nullable();
            $table->string('personal_medical_food')->after('personal_medical_animal')->nullable();
            $table->string('to_be_future')->after('personal_medical_food')->nullable();
            $table->string('to_be_future_desc')->after('to_be_future')->nullable();
            $table->string('re_learn')->after('to_be_future_desc')->nullable();
            $table->string('advantage')->after('re_learn')->nullable();
            $table->string('disAdvantage')->after('advantage')->nullable();
            $table->string('hobbies')->after('disAdvantage')->nullable();
            $table->string('talent')->after('hobbies')->nullable();
            $table->string('sport')->after('talent')->nullable();
            $table->string('has_sport_man')->after('sport')->nullable();
            $table->string('music')->after('has_sport_man')->nullable();
            $table->string('use_computer')->after('music')->nullable();
            $table->string('use_computer_for')->after('use_computer')->nullable();
            $table->string('socialMedia1')->after('use_computer_for')->nullable();
            $table->string('socialMedia2')->after('socialMedia1')->nullable();
            $table->string('socialMedia3')->after('socialMedia2')->nullable();
            $table->string('feel_to_block_internet')->after('socialMedia3')->nullable();
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

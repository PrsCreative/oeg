<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHighSchoolExchangeExciteCampLocationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('high_school_exchange_excite_camp_location', function( Blueprint $table ) {
            $table->increments('id');
            $table->string('year');
            $table->string('province');
            $table->string('name');
            $table->date('date');
            $table->integer('amount');
            $table->integer('used')->default(0);
            $table->string('status');
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
        //
        Schema::dropIfExists('high_school_exchange_excite_camp_location');
    }
}
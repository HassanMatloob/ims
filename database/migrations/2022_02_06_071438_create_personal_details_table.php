<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonalDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personal_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('indigency_id')->constrained();
            $table->string('surname');
            $table->string('initials');
            $table->string('maiden_name');
            $table->bigInteger('account_number');
            $table->bigInteger('id_number');
            $table->string('res_address');
            $table->integer('res_postal_code');
            $table->string('postal_address');
            $table->integer('postal_code');
            $table->boolean('pensioner');
            $table->string('gender');
            $table->integer('ward_number');
            $table->string('employment_status');
            $table->boolean('electricity_meter');
            $table->boolean('alternative_energy');
            $table->boolean('rates');
            $table->boolean('water');
            $table->boolean('toilet_facility');
            $table->string('erf');
            $table->string('name_of_employer');
            $table->string('employer_address');
            $table->bigInteger('employer_tel');
            $table->string('marital_status');
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
        Schema::dropIfExists('personal_details');
    }
}

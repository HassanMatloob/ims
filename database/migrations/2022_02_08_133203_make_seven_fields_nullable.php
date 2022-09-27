<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeSevenFieldsNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('personal_details', function (Blueprint $table) {
            $table->boolean('alternative_energy')->nullable()->change();
            $table->boolean('rates')->nullable()->change();
            $table->boolean('water')->nullable()->change();
            $table->string('name_of_employer')->nullable()->change();
            $table->string('employer_address')->nullable()->change();
            $table->bigInteger('employer_tel')->nullable()->change();
            $table->boolean('toilet_facility')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('personal_details', function (Blueprint $table) {
            $table->boolean('alternative_energy')->nullable(false)->change();
            $table->boolean('rates')->nullable(false)->change();
            $table->boolean('water')->nullable(false)->change();
            $table->string('name_of_employer')->nullable(false)->change();
            $table->string('employer_address')->nullable(false)->change();
            $table->bigInteger('employer_tel')->nullable(false)->change();
            $table->boolean('toilet_facility')->nullable(false)->change();
        });
    }
}

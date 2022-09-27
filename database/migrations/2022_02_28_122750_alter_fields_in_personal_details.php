<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterFieldsInPersonalDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('personal_details', function (Blueprint $table) {
            $table->string('account_number', 8)->change();
            $table->string('id_number', 13)->change();
            $table->string('electricity_meter', 11)->change();
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
            $table->bigInteger('account_number', 20)->change();
            $table->bigInteger('id_number', 20)->change();
            $table->bigInteger('electricity_meter', 20)->change();
        });
    }
}

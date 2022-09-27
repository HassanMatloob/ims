<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsInIndigenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('indigencies', function (Blueprint $table) {
            $table->string('surname', 25)->after('firstName');
            $table->string('id_number', 13);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('indigencies', function (Blueprint $table) {
            $table->dropColumn('surname');
            $table->dropColumnIfExists('id_number');
        });
    }
}

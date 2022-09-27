<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProPicFieldToIndigenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('indigencies', function (Blueprint $table) {
            $table->string('pro_pic')->default('blank-profile-picture-973460_1280.png');
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
            $table->dropColumn('pro_pic');
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyStatusDefaultValueInIndigenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('indigencies', function (Blueprint $table) {
            $table->string('status')->default('Incomplete Application')->change();
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
            $table->string('status')->nullable()->change();
        });
    }
}

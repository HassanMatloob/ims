<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFiveFieldsToPersonalDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('personal_details', function (Blueprint $table) {
            $table->date('d_o_b');
            $table->string('home_tel')->nullable();
            $table->string('cell_number');
            $table->string('work_tel')->nullable();
            $table->string('other_contact')->nullable();
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
            $table->dropColumn(['d_o_b', 'home_tel', 'cell_number', 'work_tel', 'other_contact']);
        });
    }
}

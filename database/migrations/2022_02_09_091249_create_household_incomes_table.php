<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHouseholdIncomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('household_incomes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('indigency_id')->constrained('indigencies');
            $table->string('full_name');
            $table->string('relationship');
            $table->string('gender');
            $table->date('date_of_birth');
            $table->float('income_from_employment')->nullable();
            $table->float('old_age_pension')->nullable();
            $table->float('dis_pension')->nullable();
            $table->float('child_support_grant')->nullable();
            $table->float('cash_from_relatives')->nullable();
            $table->float('total_income');
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
        Schema::dropIfExists('household_incomes');
    }
}

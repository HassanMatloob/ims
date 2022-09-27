<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('indigency_id')->constrained();
            $table->string('municipal_acc_doc');
            $table->string('id_doc');
            $table->string('confirmation_of_pension')->nullable();
            $table->string('proof_of_income')->nullable();
            $table->string('affidavit')->nullable();
            $table->string('death_cert')->nullable();
            $table->string('letter_from_council')->nullable();
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
        Schema::dropIfExists('documents');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTreatmentOutcomeFormTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('treatment_outcome_form', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('form_id');
            $table->foreign('form_id')->references('id')->on('tb_mac_forms')->onDelete('cascade');

            $table->string('tb_case_number');
            $table->date('date_started_treatment')->nullable();
            $table->string('current_drug_susceptibility');
            $table->string('outcome');
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
        Schema::dropIfExists('treatment_outcome_form');
    }
}

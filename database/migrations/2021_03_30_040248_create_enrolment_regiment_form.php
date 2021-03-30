<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnrolmentRegimentForm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enrolment_regiment_form', function (Blueprint $table) {
            $table->id();
            $table->integer('form_id');
            $table->string('treatment_history')->nullable();
            $table->string('registration_group')->nullable();
            $table->string('risk_factor')->nullable();
            $table->string('current_bacteriological_status')->nullable();
            $table->string('dst_from_other_lab')->nullable();
            $table->string('tb_disease_classification')->nullable();
            $table->string('current_weight')->nullable();
            $table->string('suggested_regimen')->nullable();
            $table->string('if_for_empiric_treatment')->nullable();
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
        Schema::dropIfExists('enrolment_regiment_form');
    }
}

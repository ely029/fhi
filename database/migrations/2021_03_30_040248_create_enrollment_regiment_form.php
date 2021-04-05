<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnrollmentRegimentForm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enrollment_regiment_form', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('form_id');
            $table->foreign('form_id')->references('id')->on('tb_mac_forms')->onDelete('cascade');
            
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
        Schema::dropIfExists('enrollment_regiment_form');
    }
}

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
        if (!Schema::hasTable('enrollment_regiment_form')) {
            Schema::create('enrollment_regiment_form', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('form_id');
                $table->foreign('form_id')->references('id')->on('tb_mac_forms')->onDelete('cascade');
                
                $table->string('treatment_history')->nullable();
                $table->string('registration_group')->nullable();
                $table->string('risk_factor')->nullable();
                $table->string('drug_susceptibility')->nullable();
                $table->string('current_weight')->nullable();
                $table->string('suggested_regimen')->nullable();
                $table->string('regimen_notes')->nullable();
                $table->string('clinical_status')->nullable();
                $table->string('signs_and_symptoms')->nullable();
                $table->string('vital_signs')->nullable();
                $table->string('diag_and_lab_findings')->nullable();
                $table->longText('treatment_history')->change();
                $table->longText('clinical_status')->change();
                $table->longText('signs_and_symptoms')->change();
                $table->longText('vital_signs')->change();
                $table->longText('diag_and_lab_findings')->change();
                $table->longText('suggested_regimen')->change();
                $table->timestamps();
            });
        }
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

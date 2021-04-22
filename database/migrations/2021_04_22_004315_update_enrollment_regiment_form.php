<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateEnrollmentRegimentForm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('enrollment_regiment_form', function (Blueprint $table) {
            $table->longText('treatment_history')->change();
                $table->longText('clinical_status')->change();
                $table->longText('signs_and_symptoms')->change();
                $table->longText('vital_signs')->change();
                $table->longText('diag_and_lab_findings')->change();
                $table->longText('suggested_regimen')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}

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
        DB::statement('ALTER TABLE enrollment_regiment_form MODIFY COLUMN treatment_history LONGTEXT');
        DB::statement('ALTER TABLE enrollment_regiment_form MODIFY COLUMN clinical_status LONGTEXT');
        DB::statement('ALTER TABLE enrollment_regiment_form MODIFY COLUMN signs_and_symptoms LONGTEXT');
        DB::statement('ALTER TABLE enrollment_regiment_form MODIFY COLUMN regimen_notes LONGTEXT');
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

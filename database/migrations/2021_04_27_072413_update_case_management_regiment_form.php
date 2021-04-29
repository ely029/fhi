<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateCaseManagementRegimentForm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('case_management_regiment_form', function (Blueprint $table) {
            $table->string('current_drug_susceptibility')->default('');
            $table->string('itr_drugs')->default('');
            $table->longText('suggested_regimen_notes')->default(null);
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

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCaseManagementLaboratoryResults extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('case_management_laboratory_results', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('form_id')->default(0);
            $table->date('cxr_date')->useCurrent();
            $table->string('label')->default('');
            $table->string('latest_comparative_cxr_reading')->default('');
            $table->string('cxr_result')->default('');
            $table->date('ct_scan_date')->useCurrent();
            $table->string('ct_scan_result')->default('');
            $table->string('ultra_sound_date')->default('');
            $table->date('histhopathological_date')->useCurrent();
            $table->longText('histhopathological_result')->default(null);
            $table->longText('remarks')->useCurrent();
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
        Schema::dropIfExists('case_management_laboratory_results');
    }
}

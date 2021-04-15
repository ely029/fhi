<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaboratoryResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laboratory_results', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('form_id');
            $table->foreign('form_id')->references('id')->on('tb_mac_forms')->onDelete('cascade');

            $table->date('cxr_date')->nullable();
            $table->text('cxr_reading')->nullable();
            $table->string('cxr_result')->nullable();

            $table->date('ct_scan_date')->nullable();
            $table->string('ct_scan_result')->nullable();

            $table->date('ultrasound_date')->nullable();
            $table->string('ultrasound_result')->nullable();
            
            $table->date('histopathological_date')->nullable();
            $table->string('histopathological_result')->nullable();

            $table->text('remarks')->nullable();

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
        Schema::dropIfExists('laboratory_results');
    }
}

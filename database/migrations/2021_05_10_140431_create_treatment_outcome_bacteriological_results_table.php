<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTreatmentOutcomeBacteriologicalResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('treatment_outcome_bacteriological_results', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('form_id');
            $table->foreign('form_id')->references('id')->on('tb_mac_forms')->onDelete('cascade');

            $table->string('type');
            $table->date('date_collected');
            $table->string('method_used')->nullable();
            $table->string('resistance_pattern')->nullable();
            $table->string('smear_microscopy')->nullable();
            $table->string('tb_lamp')->nullable();
            $table->string('culture')->nullable();
            $table->string('resistance_pattern_others')->nullable();

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
        Schema::dropIfExists('treatment_outcome_bacteriological_results');
    }
}

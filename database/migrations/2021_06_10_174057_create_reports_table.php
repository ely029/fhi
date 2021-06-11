<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->string('report_number')->nullable();
            $table->unsignedBigInteger('prepared_by');
            $table->foreign('prepared_by')->references('id')->on('users')->onDelete('cascade');
            $table->string('period');
            $table->string('year');
            $table->string('quarter')->nullable();
            $table->string('month')->nullable();
            $table->string('region');
            $table->string('province');
            $table->string('health_facility');
            $table->text('remarks');
            $table->longText('report_data');
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
        Schema::dropIfExists('reports');
    }
}

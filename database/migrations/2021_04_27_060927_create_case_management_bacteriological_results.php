<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCaseManagementBacteriologicalResults extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('case_management_bacteriological_results', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('form_id')->default(0);
            $table->string('label')->default('');
            $table->date('date_collected')->default(null);
            $table->string('resistance_pattern')->default('');
            $table->string('method_used')->default('');
            $table->string('smear_microscopy')->default('');
            $table->string('tb_lamp')->default('');
            $table->string('culture')->default('');
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
        Schema::dropIfExists('case_management_bacteriological_results');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCaseManagementRegimentForm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('case_management_regiment_form')) {
            Schema::create('case_management_regiment_form', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('form_id');
                $table->foreign('form_id')->references('id')->on('tb_mac_forms')->onDelete('cascade');
    
                $table->string('month_of_treatment')->default('');
                $table->string('current_type_of_case')->default('');
                $table->string('current_regiment')->default('');
                $table->string('reason_case_management_presentation')->default('');
                $table->string('current_weight')->default('');
                $table->string('suggested_weight')->default('');
                $table->string('updated_type_of_case')->default('');
                $table->string('suggested_regimen')->default('');
                $table->string('if_for_empiric_treatment')->default('');
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
        Schema::dropIfExists('case_management_regiment_form');
    }
}

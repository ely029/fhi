<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableMasterlist extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('enrollment_regiment_form', function (Blueprint $table) {
            $table->string('sec_remarks')->nullable();
        });

        Schema::table('case_management_regiment_form', function (Blueprint $table) {
            $table->string('sec_remarks')->nullable();
        });

        Schema::table('treatment_outcome_form', function (Blueprint $table) {
            $table->string('sec_remarks')->nullable();
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

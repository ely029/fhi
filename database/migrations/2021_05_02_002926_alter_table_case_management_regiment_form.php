<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableCaseManagementRegimentForm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('latest_comparative_cxr_reading', 'case_management_regiment_form'))  {
            Schema::table('case_management_regiment_form', function (Blueprint $table) {
                $table->string('latest_comparative_cxr_reading')->nullable();
            });
        }

        if (!Schema::hasColumn('remarks', 'case_management_regiment_form'))  {
            Schema::table('case_management_regiment_form', function (Blueprint $table) {
                $table->longText('remarks')->nullable();
            });
        }

        if (!Schema::hasColumn('case_number', 'case_management_regiment_form'))  {
            Schema::table('case_management_regiment_form', function (Blueprint $table) {
                $table->string('case_number')->nullable();
            });
        }

        if (!Schema::hasColumn('count', 'case_management_bacteriological_results'))  {
            Schema::table('case_management_bacteriological_results', function (Blueprint $table) {
                $table->string('count')->nullable();
            });
        }

        DB::statement('ALTER TABLE case_management_laboratory_results DROP COLUMN remarks');
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

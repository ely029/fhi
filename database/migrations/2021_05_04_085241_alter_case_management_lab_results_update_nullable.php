<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterCaseManagementLabResultsUpdateNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE case_management_laboratory_results MODIFY COLUMN ct_scan_result varchar(255) NULL');
        DB::statement('ALTER TABLE case_management_laboratory_results MODIFY COLUMN ct_scan_date date NULL');
        DB::statement('ALTER TABLE case_management_laboratory_results MODIFY COLUMN histhopathological_date date NULL');
        DB::statement('ALTER TABLE case_management_laboratory_results MODIFY COLUMN ultra_sound_date varchar(255) NULL');
        DB::statement('ALTER TABLE case_management_laboratory_results MODIFY COLUMN histhopathological_result LONGTEXT NULL');
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

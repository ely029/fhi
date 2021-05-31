<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUsersTableAddItisColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('itis_id')->nullable()->unique();
            $table->string('itis_access_area')->nullable();
            $table->string('region')->nullable();
            $table->string('region_code')->nullable();
            $table->boolean('has_chosen_role')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['itis_id','itis_access_area','region','region_code']);
        });
    }
}

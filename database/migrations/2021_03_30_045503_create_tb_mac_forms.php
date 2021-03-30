<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbMacForms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_mac_forms', function (Blueprint $table) {
            $table->id();
            $table->integer('submitted_by');
            $table->integer('user_id');
            $table->integer('patient_id');
            $table->string('status');
            $table->string('level');
            $table->integer('approved_by');
            $table->string('region');
            $table->integer('role_id');
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
        Schema::dropIfExists('tb_mac_forms');
    }
}

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
        if (!Schema::hasTable('tb_mac_forms')) { 
            Schema::create('tb_mac_forms', function (Blueprint $table) {
                $table->id();
    
                $table->string('presentation_number')->nullable();
                $table->unsignedBigInteger('submitted_by');
                $table->foreign('submitted_by')->references('id')->on('users');
    
                $table->string('form_type');
                $table->unsignedBigInteger('patient_id');
                
                $table->string('status');
                $table->string('level')->default('regional');
                
                $table->unsignedBigInteger('approved_by')->nullable();
                $table->foreign('approved_by')->references('id')->on('users')->onDelete('set null');
    
                $table->string('region');
    
                $table->unsignedBigInteger('role_id');
                $table->foreign('role_id')->references('id')->on('roles');
    
                $table->unsignedBigInteger('linked_tb_mac_form')->nullable();
    
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
        Schema::dropIfExists('tb_mac_forms');
    }
}

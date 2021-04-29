<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCaseManagementAttachments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('case_management_attachments', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('form_id');
            $table->foreign('form_id')->references('id')->on('tb_mac_forms')->onDelete('cascade');
            $table->string('file_name')->nullable();
            $table->char('extension', 4)->default('jpg');

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
        Schema::dropIfExists('case_management_attachments');
    }
}

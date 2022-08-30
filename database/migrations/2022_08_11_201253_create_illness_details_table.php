<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIllnessDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('illness_details', function (Blueprint $table) {
            $table->integer('medicalRecordID')->unsigned();
            $table->integer('illnessID')->unsigned();
            
            $table->foreign('medicalRecordID')->references('medicalRecordID')->on('patient_medical_records');
            $table->foreign('illnessID')->references('illnessID')->on('illnesses');
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
        Schema::dropIfExists('illness_details');
    }
}

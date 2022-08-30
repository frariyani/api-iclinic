<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTreatmentDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('treatment_details', function (Blueprint $table) {
            $table->integer('treatmentID')->unsigned();
            $table->integer('medicalRecordID')->unsigned();

            $table->foreign('treatmentID')->references('treatmentID')->on('treatments');
            $table->foreign('medicalRecordID')->references('medicalRecordID')->on('patient_medical_records');

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
        Schema::dropIfExists('treatment_details');
    }
}

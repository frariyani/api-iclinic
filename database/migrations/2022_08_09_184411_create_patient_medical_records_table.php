<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientMedicalRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_medical_records', function (Blueprint $table) {
            $table->increments('medicalRecordID');
            $table->date('date');
            $table->float('temperature');
            $table->float('paymentTotal')->nullable();
            $table->integer('systolic')->nullable();
            $table->integer('diastolic')->nullable();

            $table->integer('doctorID')->unsigned();
            $table->integer('patientID')->unsigned();

            $table->foreign('doctorID')->references('userID')->on('users');
            $table->foreign('patientID')->references('patientID')->on('patients');

            $table->dateTime('deleted_at')->nullable();
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
        Schema::dropIfExists('patient_medical_records');
    }
}

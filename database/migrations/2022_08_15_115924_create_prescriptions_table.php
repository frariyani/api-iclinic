<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prescriptions', function (Blueprint $table) {
            $table->integer('medicalRecordID')->unsigned();
            $table->integer('medicineID')->unsigned();

            $table->string('dosage', 255);
            $table->integer('quantity');
            $table->float('subTotal');

            $table->foreign('medicalRecordID')->references('medicalRecordID')->on('patient_medical_records');
            $table->foreign('medicineID')->references('medicineID')->on('medicines');

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
        Schema::dropIfExists('prescriptions');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('paymentID');

            $table->string('method')->nullable();
            $table->float('paymentTotal')->default(0);
            $table->date('date')->nullable();
            $table->integer('medicalRecordID')->unsigned();
            $table->boolean('isPaid')->default(0);

            $table->string('paymentCode')->nullable();

            $table->foreign('medicalRecordID')->references('medicalRecordID')->on('patient_medical_records');

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
        Schema::dropIfExists('payments');
    }
}

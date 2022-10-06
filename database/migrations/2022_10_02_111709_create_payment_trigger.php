<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
            CREATE TRIGGER create_payment
            AFTER INSERT ON patient_medical_records
            FOR EACH ROW
                BEGIN
                    INSERT INTO payments (medicalRecordID, date)
                    VALUES(NEW.medicalRecordID, NEW.date);
                END
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER "create_payment"');
    }
}

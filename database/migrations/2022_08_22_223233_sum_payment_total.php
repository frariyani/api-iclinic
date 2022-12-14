<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SumPaymentTotal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        DB::unprepared('
        CREATE TRIGGER sum_payment_total
        AFTER INSERT ON prescriptions 
        FOR EACH ROW
            BEGIN
                UPDATE payments 
                SET paymentTotal = (SELECT SUM(subTotal) FROM prescriptions WHERE medicalRecordID = NEW.medicalRecordID AND status = 1)
                                   + (SELECT SUM(t.treatmentPrice) FROM treatments t JOIN treatment_details td
                                        ON t.treatmentID = td.treatmentID
                                        WHERE td.medicalRecordID = NEW.medicalRecordID
                                     )
                WHERE medicalRecordID = NEW.medicalRecordID
                                    ;
                
                UPDATE medicines SET supply = supply - NEW.quantity 
                WHERE medicineID = NEW.medicineID;
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
        //
        DB::unprepared('DROP TRIGGER "sum_payment_total"');
    }
}

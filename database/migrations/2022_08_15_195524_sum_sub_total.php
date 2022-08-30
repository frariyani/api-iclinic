<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SumSubTotal extends Migration
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
            CREATE TRIGGER sum_sub_total
            BEFORE INSERT ON prescriptions 
            FOR EACH ROW
                BEGIN
                    SET NEW.subTotal = NEW.quantity * (SELECT pricePerUnit FROM medicines WHERE medicineID = NEW.medicineID);
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
        DB::unprepared('DROP TRIGGER "sum_sub_total"');
    }
}

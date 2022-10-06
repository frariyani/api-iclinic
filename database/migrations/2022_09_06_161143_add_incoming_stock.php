<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIncomingStock extends Migration
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
            CREATE TRIGGER add_incoming_stock
            AFTER INSERT ON incoming_stocks
            FOR EACH ROW
                BEGIN
                    UPDATE medicines
                    SET supply = supply + NEW.quantity
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
        DB::unprepared('DROP TRIGGER "add_incoming_stock"');

    }
}

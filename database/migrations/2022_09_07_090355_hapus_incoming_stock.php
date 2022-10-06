<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class HapusIncomingStock extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
            CREATE TRIGGER delete_incoming_stock
            BEFORE UPDATE ON incoming_stocks
            FOR EACH ROW
                BEGIN
                    UPDATE medicines
                    SET supply = supply - OLD.quantity
                                WHERE medicineID = OLD.medicineID;
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
        DB::unprepared('DROP TRIGGER "delete_incoming_stock"');
    }
}

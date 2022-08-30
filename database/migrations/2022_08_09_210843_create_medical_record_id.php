<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicalRecordId extends Migration
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
            CREATE TRIGGER medical_record_id BEFORE INSERT ON patients FOR EACH ROW
                BEGIN
                    INSERT INTO sequences VALUES (NULL);
                    SET NEW.medicalRecordNumber = CONCAT(LAST_INSERT_ID(), "-", FLOOR(RAND() * (90-10)+10), "-", DAYOFYEAR(SYSDATE()));
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
        DB::unprepared('DROP TRIGGER "medical_record_id"');
    }
}

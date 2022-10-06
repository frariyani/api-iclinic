<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Prescription extends Pivot
{
    //
    protected $table = 'prescriptions';

    protected $fillable = [
        'medicalRecordID', 'medicineID', 'dosage', 'quantity', 'subTotal', 'status'
    ];
}

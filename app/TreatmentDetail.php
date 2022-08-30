<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class TreatmentDetail extends Pivot
{
    //
    protected $table = 'treatment_details';

    protected $fillable = [
        'treatmentID', 'medicalRecordID'
    ];
}

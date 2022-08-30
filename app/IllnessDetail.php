<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class IllnessDetail extends Pivot
{
    //
    protected $table = 'illness_details';

    protected $fillable = [
        'medicalRecordID', 'illnessID'
    ];
}

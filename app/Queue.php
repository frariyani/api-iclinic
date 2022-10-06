<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class Queue extends Model
{
    //
    use SoftDeletes;

    protected $primaryKey = 'queueID';
    protected $table = 'queues';
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'patientID', 'date', 'status', 'queueNumber'
    ];

    public function patient(){
        return $this->belongsTo(Patient::class, 'patientID');
    }

    public function medicalRecord(){
        return $this->belongsTo(PatientMedicalRecord::class, 'patientID');
    }
}

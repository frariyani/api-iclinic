<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    //
    use SoftDeletes;

    protected $primaryKey = 'paymentID';

    protected $table = 'payments';

    protected $dates = ['deleted_at'];

    protected $fillable = [ 'method', 'paymentTotal', 'date', 'medicalRecordID', 'isPaid', 'paymentCode'];

    public function medicalRecord(){
        return $this->hasOne(PatientMedicalRecord::class, 'medicalRecordID');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class PatientMedicalRecord extends Model
{
    //
    use SoftDeletes;

    protected $primaryKey = 'medicalRecordID';

    protected $table = 'patient_medical_records';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'date' , 'temperature', 'systolic', 'diastolic', 'doctorID', 'patientID', 'isDone'
    ];

    public function illnessess(){
        return $this->belongsToMany(Illness::class, 'illness_details', 'medicalRecordID', 'illnessID')
               ->withTimestamps();
    }

    public function treatments(){
        return $this->belongsToMany(Treatment::class, 'treatment_details', 'medicalRecordID', 'treatmentID')
                ->withTimestamps();
    }

    public function prescriptions(){
        return $this->belongsToMany(Medicine::class, 'prescriptions', 'medicalRecordID', 'medicineID')
                ->withPivot('dosage', 'quantity', 'subTotal', 'status')
                ->withTimestamps();
    }

    public function getCreatedAtAtrribute(){
        if(!is_null($this->attributes['created_at'])){
            return Carbon::parse($this->attributes['created_at'])->format('d-m-Y H:i:s');
        }
    }

    public function getUpdatedAtAttribute(){
        if(!is_null($this->attributes['updated_at'])){
            return Carbon::parse($this->attributes['updated_at'])->format('d-m-Y H:i:s');
        }
    }

    public function patient(){
        return $this->belongsTo(Patient::class, 'patientID');
    }

    public function doctor(){
        return $this->hasOne(User::class, 'userID', 'doctorID');
    }

    public function queue(){
        return $this->hasMany(Queue::class, 'patientID');
    }

    public function payment(){
        return $this->hasOne(Payment::class, 'medicalRecordID');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class Illness extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'illnessID';

    protected $table = 'illnesses';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'illnessName', 'description', 'advice'
    ];

    public function medicalRecords(){
        return $this->belongsToMany(PatientMedicalRecord::class, 'illness_details', 'illnessID', 'medicalRecordID')
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
}

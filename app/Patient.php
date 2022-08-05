<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patient extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'patientID';

    protected $table = 'patients';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'fullname', //done
        'address', //done
        'weight', 
        'birthdate', //done 
        'gender' //done
    ];

    protected $cast = [
        'birthdate' => 'datetime:d-m-Y',
        'created_at' => 'datetime:d-m-Y',
        'updated_at' => 'datetime:d-m-Y'
    ];

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

    public function getBirthDateAttribute(){
        return $this->birthdate->format('d/m/Y');
    }


}

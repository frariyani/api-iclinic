<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class Treatment extends Model
{
    //
    use SoftDeletes;

    protected $primaryKey = 'treatmentID';

    protected $table = 'treatments';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'treatmentName', 'treatmentPrice'
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
}

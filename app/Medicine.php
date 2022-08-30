<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class Medicine extends Model
{
    //
    use SoftDeletes;

    protected $primaryKey = 'medicineID';

    protected $table = 'medicines';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'medicineName', 'supply', 'unit', 'pricePerUnit'
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

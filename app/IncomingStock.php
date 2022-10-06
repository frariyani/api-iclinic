<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IncomingStock extends Model
{
    //
    use SoftDeletes;

    protected $primaryKey = 'incomingStockID';

    protected $table = 'incoming_stocks';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'quantity', 'date', 'medicineID'
    ];

    public function medicine(){
        return $this->belongsTo(Medicine::class, 'medicineID', 'medicineID');
    }
}

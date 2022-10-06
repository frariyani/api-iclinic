<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class File extends Model
{
    //
    use SoftDeletes;

    protected $primaryKey = 'fileID';
    protected $table = 'files';
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'title', 'URL', 'patientID'
    ];  

    public function patient(){
        return $this->belongsTo(Patient::class, 'patientID');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    //
    use SoftDeletes;

    protected $primaryKey = 'roleID';

    protected $table = 'roles';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'rolename'
    ];

    public function getCreatedAtAtrribute(){
        if(!is_null($this->attributes['created_at'])){
            return Carbon::parse($this->attributes['created_at'])->format('Y-m-d H:i:s');
        }
    }

    public function getUpdatedAtAttribute(){
        if(!is_null($this->attributes['updated_at'])){
            return Carbon::parse($this->attributes['updated_at'])->format('Y-m-d H:i:s');
        }
    }

    public function users(){
        return $this->hasMany(Role::class, 'roleID');
    }

    public function menus(){
        return $this->belongsToMany(Menu::class, 'detail_menus', 'roleID', 'menuID');
    }
}

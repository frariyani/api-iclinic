<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{

    protected $primaryKey = 'menuID';

    protected $table = 'menus';

    protected $fillable = [
        'menuName', 'category', 'path', 'title'
    ];

    public function roles(){
        return $this->belongsToMany(Role::class, 'detail_menus', 'menuID', 'roleID');
    }
}

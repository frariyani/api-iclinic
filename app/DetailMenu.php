<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class DetailMenu extends Pivot
{
    protected $table = 'detail_menus';

    protected $fillable = [
        'menuID', 'roleID'
    ];
}

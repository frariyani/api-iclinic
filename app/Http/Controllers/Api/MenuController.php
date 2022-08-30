<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Menu;
use App\Role;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
    //
    public function getMenu(){
        $roleID = Auth::user()->roleID;

        $menuDashboard = Role::query()
                ->with(['menus' => function($query){
                    $query->select('*')->where('category', '=', 'Dashboard');
                }])
                ->where('roleID', '=', $roleID)
                ->first();

        $menuMaster = Role::query()
                ->with(['menus' => function($query){
                    $query->select('*')->where('category', '=', 'Master');
                }])
                ->where('roleID', '=', $roleID)
                ->first();

        $menuUser = Role::query()
                ->with(['menus' => function($query){
                    $query->select('*')->where('category', '=', 'User');
                }])
                ->where('roleID', '=', $roleID)
                ->first();

        $menuReport = Role::query()
                ->with(['menus' => function($query){
                    $query->select('*')->where('category', '=', 'Report');
                }])
                ->where('roleID', '=', $roleID)
                ->first();
    
        return response([
            'menuDashboard' => $menuDashboard,
            'menuMaster' => $menuMaster,
            'menuUser' => $menuUser,
            'menuReport' => $menuReport
        ]);
    }
}

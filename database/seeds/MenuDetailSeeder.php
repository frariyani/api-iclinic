<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\Menu;

class MenuDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $adminRole = Role::find(1)->roleID;
        $doctorRole = Role::find(2)->roleID;
        $pendaftarRole = Role::find(3)->roleID;

        $menus = Menu::all();

        // $menusPendaftar = Menu::whereIn('menuID', array(1, 2, 3))->get();

        foreach($menus as $menu){
            if($menu['menuID'] != 2 || $menu['menuID'] != 3){
                $menu->roles()->attach($adminRole);
            }

            if($menu['menuID'] != 7){
                $menu->roles()->attach($doctorRole);
            }

            if($menu['menuID'] <= 3){
                $menu->roles()->attach($pendaftarRole);
            }
        }


    }
}

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

        $menus = Menu::all();

        foreach($menus as $menu){
            if($menu['menuID'] != 2){
                $menu->roles()->attach($adminRole);
            }

            if($menu['menuID'] != 6){
                $menu->roles()->attach($doctorRole);
            }
        }
    }
}

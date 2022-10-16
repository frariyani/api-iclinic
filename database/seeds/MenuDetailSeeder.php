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
        $petugasObatRole = Role::find(4)->roleID;
        $kasirRole = Role::find(5)->roleID;
        $superAdminRole = Role::find(6)->roleID;

        $menus = Menu::all();

        $arrMenuAdmin = array(1, 6, 7, 8, 9, 10, 11, 12, 13, 14);
        $arrMenuDokter = array(1, 2, 3, 6, 10, 11, 12, 13, 14);
        $arrMenuPendaftar = array(1, 2, 10);
        $arrMenuPetugasObat = array(1, 4, 10);
        $arrMenuKasir = array(1, 5, 10);

        // $menusPendaftar = Menu::whereIn('menuID', array(1, 2, 3))->get();

        foreach($menus as $menu){
            if(in_array($menu['menuID'], $arrMenuAdmin)){
                $menu->roles()->attach($adminRole);
                $menu->roles()->attach($superAdminRole);
            }

            if(in_array($menu['menuID'], $arrMenuDokter)){
                $menu->roles()->attach($doctorRole);
            }

            if(in_array($menu['menuID'], $arrMenuPendaftar)){
                $menu->roles()->attach($pendaftarRole);
            }

            if(in_array($menu['menuID'], $arrMenuPetugasObat)){
                $menu->roles()->attach($petugasObatRole);
            }

            if(in_array($menu['menuID'], $arrMenuKasir)){
                $menu->roles()->attach($kasirRole);
            }
        }


    }
}

// if($menu['menuID'] != 2 || $menu['menuID'] != 3){
//     $menu->roles()->attach($adminRole);
// }

// if($menu['menuID'] != 7){
//     $menu->roles()->attach($doctorRole);
// }

// if($menu['menuID'] <= 3){
//     $menu->roles()->attach($pendaftarRole);
// }

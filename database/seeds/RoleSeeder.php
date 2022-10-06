<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('roles')->insert([
            [
                'roleName' => 'Admin'
            ],
            [
                'roleName' => 'Dokter'
            ],
            [
                'roleName' => 'Pendaftar'
            ],
            [
                'roleName' => 'Petugas Obat'
            ],
            [
                'roleName' => 'Kasir'
            ]
        ]);
    }
}

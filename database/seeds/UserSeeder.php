<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'username' => 'test1',
                'password' => bcrypt('pass123'),
                'fullname' => 'Test',
                'roleID' => '1'
            ],
            [
                'username' => 'dokter',
                'password' => bcrypt('dokter'),
                'fullname' => 'Dokter',
                'roleID' => '2'
            ],
            [
                'username' => 'pendaftar',
                'password' => bcrypt('pendaftar'),
                'fullname' => 'Pendaftar',
                'roleID' => '3'
            ],
            [
                'username' => 'petugasobat',
                'password' => bcrypt('petugasobat'),
                'fullname' => 'Petugas Obat',
                'roleID' => '4'
            ],
            [
                'username' => 'kasir',
                'password' => bcrypt('kasir'),
                'fullname' => 'Kasir',
                'roleID' => '5'
            ],
        ]);
    }
}

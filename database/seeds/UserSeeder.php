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
                'username' => 'anastasiaardi',
                'password' => bcrypt('adminardi'),
                'fullname' => 'Anastasia Ardiningsih',
                'roleID' => '6'
            ],
            [
                'username' => 'drnrimanto',
                'password' => bcrypt('doktermanto'),
                'fullname' => 'Nrimanto',
                'roleID' => '2'
            ],
            [
                'username' => 'rizkihamdala',
                'password' => bcrypt('pendaftarrizki'),
                'fullname' => 'Rizki Hamdala',
                'roleID' => '3'
            ],
            [
                'username' => 'srirejeki',
                'password' => bcrypt('pendaftarjeki'),
                'fullname' => 'Sri Rejeki',
                'roleID' => '3'
            ],
            [
                'username' => 'bagaswardhana',
                'password' => bcrypt('pendaftarbagas'),
                'fullname' => 'Bagas Wardhana',
                'roleID' => '3'
            ],
            [
                'username' => 'ekowardoyo',
                'password' => bcrypt('obatwardoyo'),
                'fullname' => 'Eko Wardoyo',
                'roleID' => '4'
            ],
            [
                'username' => 'pujiono',
                'password' => bcrypt('obatpujiono'),
                'fullname' => 'Pujiono',
                'roleID' => '4'
            ],
            [
                'username' => 'dhalandha',
                'password' => bcrypt('obatdhalan'),
                'fullname' => 'Dhalan',
                'roleID' => '4'
            ],
            [
                'username' => 'srisulasmi',
                'password' => bcrypt('kasirsulasmi'),
                'fullname' => 'Sri Sulasmi',
                'roleID' => '5'
            ],
            [
                'username' => 'puspitasari',
                'password' => bcrypt('kasirita'),
                'fullname' => 'Puspitasari',
                'roleID' => '5'
            ],
        ]);
    }
}

<?php

use Illuminate\Database\Seeder;
use App\Menu;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('menus')->truncate();

        $menus = [
            //1
            [
                'menuName' => 'Dashboard',
                'category' => 'Dashboard',
                'path' => '',
                'title' => 'Dashboard'
            ],

            //2
            [
                'menuName' => 'Manajemen Antrian',
                'category' => 'Dashboard',
                'path' => 'manageantrian',
                'title' => 'Manajemen Antrian'
            ],

            //3
            [
                'menuName' => 'Data Pasien & Rekam Medis',
                'category' => 'Dashboard',
                'path' => 'datapasien',
                'title' => 'Data Pasien & Rekam Medis'
            ],

            //4
            [
                'menuName' => 'Antrian Resep Obat',
                'category' => 'Dashboard',
                'path' => 'antrianobat',
                'title' => 'Antrian Resep Obat'
            ],

            //5
            [
                'menuName' => 'Transaksi',
                'category' => 'Dashboard',
                'path' => 'transaksi',
                'title' => 'Transaksi'
            ],

            //6
            [
                'menuName' => 'Data Penyakit',
                'category' => 'Master',
                'path' => 'datapenyakit',
                'title' => 'Data Penyakit'
            ],

            //7
            [
                'menuName' => 'Data Obat',
                'category' => 'Master',
                'path' => 'dataobat',
                'title' => 'Data Obat'
            ],

            //8
            [
                'menuName' => 'Data Perawatan',
                'category' => 'Master',
                'path' => 'dataperawatan',
                'title' => 'Data Perawatan'
            ],

            //9
            [
                'menuName' => 'Data User',
                'category' => 'User',
                'path' => 'datauser',
                'title' => 'Data User'
            ],

            //10
            [
                'menuName' => 'Ubah Password',
                'category' => 'User',
                'path' => 'ubahpassword',
                'title' => 'Ubah Password'
            ],

            //11
            [
                'menuName' => 'Laporan Kunjungan Harian',
                'category' => 'Report',
                'path' => 'kunjunganharian',
                'title' => 'Laporan Kunjungan Harian'
            ],

            //12
            [
                'menuName' => 'Laporan Pendapatan Harian',
                'category' => 'Report',
                'path' => 'pendapatanharian',
                'title' => 'Laporan Pendapatan Harian'
            ],

            //13
            [
                'menuName' => 'Laporan Penggunaan Obat',
                'category' => 'Report',
                'path' => 'laporanobat',
                'title' => 'Laporan Penggunaan Obat'
            ],

            //14
            [
                'menuName' => 'Laporan Bulanan',
                'category' => 'Report',
                'path' => 'laporanbulanan',
                'title' => 'Laporan Bulanan'
            ],
        ];

        foreach($menus as $menu){
            Menu::create($menu);
        }
    }
}

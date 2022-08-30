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
            [
                'menuName' => 'Dashboard',
                'category' => 'Dashboard',
                'path' => '/',
                'title' => 'Dashboard'
            ],
            [
                'menuName' => 'Data Pasien & Rekam Medis',
                'category' => 'Dashboard',
                'path' => 'datapasien',
                'title' => 'Data Pasien & Rekam Medis'
            ],
            [
                'menuName' => 'Data Penyakit',
                'category' => 'Master',
                'path' => 'datapenyakit',
                'title' => 'Data Penyakit'
            ],
            [
                'menuName' => 'Data Obat',
                'category' => 'Master',
                'path' => 'dataobat',
                'title' => 'Data Obat'
            ],
            [
                'menuName' => 'Data Perawatan',
                'category' => 'Master',
                'path' => 'dataperawatan',
                'title' => 'Data Perawatan'
            ],
            [
                'menuName' => 'Data User',
                'category' => 'User',
                'path' => 'datauser',
                'title' => 'Data User'
            ],
            [
                'menuName' => 'Ubah Password',
                'category' => 'User',
                'path' => 'ubahpassword',
                'title' => 'Ubah Password'
            ],
            [
                'menuName' => 'Laporan Kunjungan Harian',
                'category' => 'Report',
                'path' => 'kunjunganharian',
                'title' => 'Laporan Kunjungan Harian'
            ],
            [
                'menuName' => 'Laporan Pendapatan Harian',
                'category' => 'Report',
                'path' => 'pendapatanharian',
                'title' => 'Laporan Pendapatan Harian'
            ],
            [
                'menuName' => 'Laporan Penggunaan Obat',
                'category' => 'Report',
                'path' => 'laporanobat',
                'title' => 'Laporan Penggunaan Obat'
            ],
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

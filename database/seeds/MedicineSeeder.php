<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class MedicineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('medicines')->insert([
            [
                'medicineName' => 'Sirup Paracetamol',
                'supply' => '150',
                'unit' => 'Sirup',
                'pricePerUnit' => '15000',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'medicineName' => 'Tablet Paracetamol',
                'supply' => '230',
                'unit' => 'Tablet',
                'pricePerUnit' => '10000',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'medicineName' => 'Tablet Amoxicillin',
                'supply' => '190',
                'unit' => 'Tablet',
                'pricePerUnit' => '7000',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'medicineName' => 'Sirup Amoxicillin',
                'supply' => '125',
                'unit' => 'Sirup',
                'pricePerUnit' => '9000',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'medicineName' => 'Cefadroxil',
                'supply' => '160',
                'unit' => 'Kapsul',
                'pricePerUnit' => '21500',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'medicineName' => 'Cefixime',
                'supply' => '170',
                'unit' => 'Kapsul',
                'pricePerUnit' => '25000',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'medicineName' => 'Albothyl',
                'supply' => '160',
                'unit' => 'Sirup',
                'pricePerUnit' => '16000',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'medicineName' => 'Loperamid',
                'supply' => '120',
                'unit' => 'Tablet',
                'pricePerUnit' => '11000',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'medicineName' => 'Dexametasone',
                'supply' => '180',
                'unit' => 'Tablet',
                'pricePerUnit' => '16000',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'medicineName' => 'Meloxicam',
                'supply' => '200',
                'unit' => 'Tablet',
                'pricePerUnit' => '6000',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'medicineName' => 'Antimigren',
                'supply' => '150',
                'unit' => 'Tablet',
                'pricePerUnit' => '19000',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'medicineName' => 'Asam Askorbat (Vit C)',
                'supply' => '80',
                'unit' => 'Tablet',
                'pricePerUnit' => '9500',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'medicineName' => 'Dektrometorfan',
                'supply' => '100',
                'unit' => 'Sirup',
                'pricePerUnit' => '9800',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'medicineName' => 'Tiamfenikol',
                'supply' => '110',
                'unit' => 'Kapsul',
                'pricePerUnit' => '18000',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'medicineName' => 'Salbutamol',
                'supply' => '200',
                'unit' => 'Tablet',
                'pricePerUnit' => '15000',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'medicineName' => 'Tablet Ambroxol',
                'supply' => '150',
                'unit' => 'Tablet',
                'pricePerUnit' => '5500',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'medicineName' => 'Sirup Ambroxol',
                'supply' => '100',
                'unit' => 'Sirup',
                'pricePerUnit' => '6000',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
        ]);
    }
}

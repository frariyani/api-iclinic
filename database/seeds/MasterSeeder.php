<?php

use Illuminate\Database\Seeder;

class MasterSeeder extends Seeder
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
                'medicineName' => 'Obat1',
                'supply' => '2000',
                'unit' => 'Tablet',
                'pricePerUnit' => '200'
            ],
            [
                'medicineName' => 'Obat2',
                'supply' => '3000',
                'unit' => 'Tablet',
                'pricePerUnit' => '300'
            ],
            [
                'medicineName' => 'Obat3',
                'supply' => '4000',
                'unit' => 'Tablet',
                'pricePerUnit' => '400'
            ],
            [
                'medicineName' => 'Obat4',
                'supply' => '5000',
                'unit' => 'Tablet',
                'pricePerUnit' => '500'
            ],
            [
                'medicineName' => 'Obat5',
                'supply' => '6000',
                'unit' => 'Tablet',
                'pricePerUnit' => '600'
            ],
        ]);

        DB::table('illnesses')->insert([
            [
                'illnessName' => 'Penyakit 1',
                'description' => 'penyakit1',
                'advice' => 'penyakit1'
            ],
            [
                'illnessName' => 'Penyakit 2',
                'description' => 'penyakit2',
                'advice' => 'penyakit2'
            ]
        ]);

        DB::table('treatments')->insert([
            [
                'treatmentName' => 'Treatment 1',
                'treatmentPrice' => '5000',
            ],
            [
                'treatmentName' => 'Treatment 2',
                'treatmentPrice' => '6000',
            ]
        ]);

        DB::table('patients')->insert([
            [
                'fullname' => 'Pasien 1',
                'address' => 'alamat 1',
                'weight' => '55',
                'birthdate' => '2000-12-12',
                'gender' => 'Pria'
            ]
        ]);
    }
}

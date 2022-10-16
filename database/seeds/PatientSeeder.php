<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('patients')->insert([
            [
                'fullname' => 'Ghani Wibowo',
                'address' => 'Gg. Dieng, Wero',
                'weight' => '80',
                'birthdate' => '2001-05-22',
                'gender' => 'Pria',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'fullname' => 'Suheru Firmansyah',
                'address' => 'Jl. Sapta Marga, Sidayu',
                'weight' => '66',
                'birthdate' => '1993-12-24',
                'gender' => 'Pria',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'fullname' => 'Diah Purwanti',
                'address' => 'Jl. Sawangan, Banjarsari',
                'weight' => '49',
                'birthdate' => '1998-04-27',
                'gender' => 'Wanita',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'fullname' => 'Rini Kuswandari',
                'address' => 'Jl. Yos Sudarso, Gombong',
                'weight' => '55',
                'birthdate' => '1995-03-23',
                'gender' => 'Wanita',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'fullname' => 'Puput Putri Lailasari',
                'address' => 'Jl. Puring - Gombong, Kalitengah',
                'weight' => '36',
                'birthdate' => '2011-05-07',
                'gender' => 'Wanita',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'fullname' => 'Haryanto',
                'address' => 'Jl. Hanoman, Wero',
                'weight' => '71',
                'birthdate' => '1988-12-24',
                'gender' => 'Pria',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'fullname' => 'Oktaviani Tari Pratiwi',
                'address' => 'Jl. Plana, Kedungpuji',
                'weight' => '67',
                'birthdate' => '1992-12-11',
                'gender' => 'Wanita',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'fullname' => 'Yuniar Anita',
                'address' => 'Gg. Beringin, Gombong',
                'weight' => '65',
                'birthdate' => '1983-08-25',
                'gender' => 'Wanita',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'fullname' => 'Nicolas Axel Pranowo',
                'address' => 'Gg. Ismoyo, Sidayu',
                'weight' => '66',
                'birthdate' => '1997-03-11',
                'gender' => 'Pria',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'fullname' => 'Okto Hidayanto',
                'address' => 'Jl. Lingkar Selatan, Semondo',
                'weight' => '64',
                'birthdate' => '1988-09-04',
                'gender' => 'Pria',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'fullname' => 'Putri Kurnia Sari',
                'address' => 'Jl. Lingkar Selatan, Kemukus',
                'weight' => '75',
                'birthdate' => '1983-10-30',
                'gender' => 'Wanita',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'fullname' => 'Gabriella Vialetta',
                'address' => 'Jl. Merbabu, Wero',
                'weight' => '45',
                'birthdate' => '2001-03-27',
                'gender' => 'Wanita',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'fullname' => 'Aisyah',
                'address' => 'Gg. Abiyoso, Sidayu',
                'weight' => '76',
                'birthdate' => '1975-10-17',
                'gender' => 'Wanita',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'fullname' => 'Sudrajat',
                'address' => 'Jl. Soponyono, Kedungpuji',
                'weight' => '87',
                'birthdate' => '1961-02-14',
                'gender' => 'Pria',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'fullname' => 'Najib Budiyanto',
                'address' => 'Jl.Karang Bolong, Kemukus',
                'weight' => '76',
                'birthdate' => '1975-10-07',
                'gender' => 'Pria',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'fullname' => 'Lanang Kusumo',
                'address' => 'Jl. Raya Gombong, Gombong',
                'weight' => '55',
                'birthdate' => '1999-06-04',
                'gender' => 'Pria',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'fullname' => 'Sasha Fauziyah Husna',
                'address' => 'Jl. Sawangan, Patemon',
                'weight' => '61',
                'birthdate' => '1990-11-16',
                'gender' => 'Wanita',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'fullname' => 'Budiman Prayogo',
                'address' => 'Jl. Kemukus, Patemon',
                'weight' => '83',
                'birthdate' => '1960-12-04',
                'gender' => 'Pria',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'fullname' => 'Daliman Zulkarnain',
                'address' => 'Gg. Gondang, Semondo',
                'weight' => '67',
                'birthdate' => '1983-09-09',
                'gender' => 'Pria',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'fullname' => 'Linda Fatikasari',
                'address' => 'Gg. Semeru, Gombong',
                'weight' => '53',
                'birthdate' => '1999-12-12',
                'gender' => 'Wanita',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'fullname' => 'Naufal Catur Halim',
                'address' => 'Jl. Soponyono, Klopogodo',
                'weight' => '38',
                'birthdate' => '2012-01-24',
                'gender' => 'Pria',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'fullname' => 'Puji Nasyidah',
                'address' => 'Jl. Makam, Kedungpuji',
                'weight' => '59',
                'birthdate' => '1979-07-20',
                'gender' => 'Wanita',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'fullname' => 'Mila Kusuma Juniar',
                'address' => 'Jl. Lingkar Selatan, Semondo',
                'weight' => '78',
                'birthdate' => '1980-02-04',
                'gender' => 'Wanita',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'fullname' => 'Suratmi',
                'address' => 'Gg. Abiyoso, Sidayu',
                'weight' => '68',
                'birthdate' => '1965-02-28',
                'gender' => 'Wanita',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'fullname' => 'Jonathan Eka Kusumo',
                'address' => 'Jl. Yudistira, Sidayu',
                'weight' => '35',
                'birthdate' => '2014-07-02',
                'gender' => 'Pria',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'fullname' => 'Jono Ramadhan',
                'address' => 'Jl. Kemukus, Patemon',
                'weight' => '82',
                'birthdate' => '1985-12-31',
                'gender' => 'Pria',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'fullname' => 'Jono Ramadhan',
                'address' => 'Patemon',
                'weight' => '82',
                'birthdate' => '1985-12-31',
                'gender' => 'Pria',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'fullname' => 'Muhammad Hasim Sarigih',
                'address' => 'Gg. Tidar, Wero',
                'weight' => '61',
                'birthdate' => '1960-02-16',
                'gender' => 'Pria',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'fullname' => 'Endah Rahimah',
                'address' => 'Klopogodo',
                'weight' => '55',
                'birthdate' => '1983-08-04',
                'gender' => 'Wanita',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
        ]);
    }
}

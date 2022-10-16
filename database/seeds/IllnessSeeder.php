<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class IllnessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('illnesses')->insert([
            [
                'illnessName' => 'Influenza',
                'description' => 'Nyeri otot, batuk, bersin, hidung tersumbat',
                'advice' => 'Makan teratur, istirahat cukup',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'illnessName' => 'Muntaber',
                'description' => 'Penyakit peradangan usus yang disebabkan oleh virus, bakteri, ataupun parasit lain seperti jamur, protozoa dan cacing',
                'advice' => 'Menjaga hidrasi',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'illnessName' => 'Cacar air',
                'description' => 'Bintik kemerahan di kulit yang menggelembung maupun tidak, melepuh, dan terasa gatal',
                'advice' => 'Beristirahat, minum obat',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'illnessName' => 'Tifus',
                'description' => 'Infeksi usus akibat bakteri',
                'advice' => 'Menjaga makan, istirahat',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'illnessName' => 'Demam',
                'description' => 'Suhu tubuh diatas 37.5C',
                'advice' => 'Minum parasetamol',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'illnessName' => 'DBD',
                'description' => 'Bintik merah, trombosit turun, kemungkinan pendarahan',
                'advice' => 'Istirahat, menjaga hidrasi',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'illnessName' => 'Disentri',
                'description' => 'Demam tinggi, mual muntah, diare hebat, lendir pada kotoran',
                'advice' => 'Menjaga kebersihan, menjaga hidrasi',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'illnessName' => 'Konjungtivitis',
                'description' => 'Mata merah dan mengeluarkan kotoran',
                'advice' => 'Diberi obat tetes mata',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'illnessName' => 'Batuk',
                'description' => 'Rasa gatal padang tenggorokan',
                'advice' => 'Minum obat batuk, kurangi es',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'illnessName' => 'Hipertensi',
                'description' => 'Tekanan darah lebih dari 140/90',
                'advice' => 'Menjaga pola makan',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'illnessName' => 'Migrain',
                'description' => 'Sakit kepala pada satu sisi kepala, kadang berdenyut',
                'advice' => 'Beristirahat, kompres, relaksasi otot',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
        ]);
    }
}

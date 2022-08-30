<?php

use Illuminate\Database\Seeder;
use App\Illness;
use App\PatientMedicalRecord;

class IllnessDetail extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $illnessArr = Illness::get();
        $medicalRecordArr = PatientMedicalRecord::get();

        foreach($medicalRecordArr as $med){
            $illnessess = Illness::inRandomOrder()->take(rand(1,3))->pluck('illnessID');
            $med->illnesssess()->attach($illnessess);
        }
    }
}

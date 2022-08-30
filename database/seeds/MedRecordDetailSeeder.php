<?php

use Illuminate\Database\Seeder;
use App\PatientMedicalRecord;
use App\Illness;
use App\Medicine;
Use App\Treatment;

class MedRecordDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $medicalRecordArr = PatientMedicalRecord::get();

        foreach($medicalRecordArr as $med){
            $treatments = Treatment::inRandomOrder()->take(rand(1,3))->pluck('treatmentID');
            $med->treatments()->attach($treatments);

            $illnessess = Illness::inRandomOrder()->take(rand(1,3))->pluck('illnessID');
            $med->illnessess()->attach($illnessess);

            $medicines = Medicine::inRandomOrder()->take(rand(1,3))->pluck('medicineID');
            $med->prescriptions()->attach($medicines, ['dosage' => 'abc', 'quantity' => rand(1, 5)]);
        }
    }
}

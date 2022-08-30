<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        factory(App\Patient::class, 50)->create();
        factory(App\PatientMedicalRecord::class, 200)->create();
    }
}

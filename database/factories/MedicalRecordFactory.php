<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\PatientMedicalRecord;
use Faker\Generator as Faker;

$factory->define(PatientMedicalRecord::class, function (Faker $faker) {
    $start_date = '2021-12-12';
    $end_date = '2022-12-12';

    $min = strtotime($start_date);
    $max = strtotime($end_date);

    $val = rand($min, $max);

    $date = date('Y-m-d H:i:s', $val);

    return [
        'date' => $date,
        'temperature' => rand(35, 45),
        'systolic' => rand(70, 150),
        'diastolic' => rand(70, 150),
        'doctorID' => 1,
        'patientID' => rand(1, 50)
    ];
});

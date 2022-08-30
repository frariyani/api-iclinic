<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Patient;
use Faker\Generator as Faker;

$factory->define(Patient::class, function (Faker $faker) {
    $gender = $faker->randomElement(['male', 'female']);

    return [
        'fullname' => $faker->name,
        'address' => 'alamat rumah',
        'weight' => 50,
        'birthdate' => '2000-01-01',
        'gender' => $gender
    ];
});

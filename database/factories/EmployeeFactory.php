<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(\App\Employee::class, function (Faker $faker) {
    return [
    'user_id' => $faker->randomNumber(3),
    'address_voivodeship' => $faker->state,
    'address_city' => $faker->city,
    'address_postal_code' => $faker->postcode,
    'address_street' => $faker->streetSuffix . ' ' .$faker->streetName,
    'address_number' => $faker->randomNumber(2),
    'correspondence_voivodeship' => $faker->state,
    'correspondence_city' => $faker->city,
    'correspondence_postal_code' => $faker->postcode,
    'correspondence_street' => $faker->streetSuffix . ' ' . $faker->streetName,
    'correspondence_number' => $faker->randomNumber(2)
    ];
});

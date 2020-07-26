<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Contact;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Contact::class, function (Faker $faker) {
    $name = $faker->company();
    return [
        'organization_id' => $faker->numberBetween($min = 1, $max = 2),
        'name' => $name,
        'slug' => Str::slug($name, '-'),
        'email' => $faker->email,
        'street' => $faker->streetAddress,
        'city' => $faker->city,
        'phone' => $faker->phoneNumber,
        'ico' => $faker->randomNumber($nbDigits = 8, $strict = false),
        'psc' => $faker->randomNumber($nbDigits = 5, $strict = false),

    ];
});

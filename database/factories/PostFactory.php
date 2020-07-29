<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Post;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Post::class, function (Faker $faker) {
    $name = $faker->sentence($nbWords = 6, $variableNbWords = true);
    return [
        'name' => $name,
        'slug' => Str::slug($name, '-'),
        'organization_id' => $faker->numberBetween($min = 1, $max = 2),
        'contact_id' => $faker->numberBetween($min = 1, $max = 2),
        'category_id' => 1,
        'number_invoice' => $faker->numberBetween($min = 1000, $max = 9000),
        'price' => $faker->numberBetween($min = 10, $max = 2000),
        'int_number' => $faker->numberBetween($min = 10, $max = 100),
        'date_in' => $faker->date($format = 'Y-m-d', $max = 'now'),
    ];
});

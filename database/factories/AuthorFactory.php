<?php

use Faker\Generator as Faker;
use App\Models\Author;

$factory->define(Author::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
    ];
});
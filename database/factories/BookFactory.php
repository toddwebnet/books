<?php

use Faker\Generator as Faker;
use App\Models\Author;
use App\Models\Book;

$factory->define(Book::class, function (Faker $faker) {
    return [
        'author_id' => Author::inRandomOrder()->first()->id,
        'title' => $faker->sentence,
        'description' => $faker->paragraph,
        'copyright' => $faker->date()
    ];
});

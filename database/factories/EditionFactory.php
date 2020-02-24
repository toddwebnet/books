<?php

use App\Models\Book;
use Carbon\Carbon;
use Faker\Generator as Faker;

use App\Models\Edition;

$factory->define(Edition::class, function (Faker $faker) {
    $book = Book::inRandomOrder()->first();
    $months = $faker->numberBetween(1, 200);
    $printDate = date("Y-m-d", (strtotime("{$book->copyright} + {$months} months")));


    do {
        $sku = (string)$faker->numberBetween(100, 999) . '-' . (string)$faker->numberBetween(100, 999);
    } while (Edition::where('sku', $sku)->count() > 0);

    return [
        'book_id' => $book->id,
        'sku' => $sku,
        'price' => $faker->randomFloat(2, 1, 1000),
        'qty_available' => $faker->numberBetween(10, 10000),
        'print_date' => $printDate
    ];
});

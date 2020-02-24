<?php

use Faker\Generator as Faker;

use App\Models\BookSales;
use App\Models\Edition;

$factory->define(BookSales::class, function (Faker $faker) {

    $edition = Edition::inRandomOrder()->first();
    $days = $faker->numberBetween(1, 1000);
    $saleDate = date("Y-m-d", (strtotime("{$edition->print_date} + {$days} days")));

    return [
        'edition_id' => $edition->id,
        'customer_first_name' => $faker->firstName,
        'customer_last_name' => $faker->lastName,
        'price' => $edition->price,
        'sale_date' => $saleDate
    ];
});

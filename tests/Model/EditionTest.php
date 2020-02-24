<?php

namespace Tests\Model;

use App\Models\Book;
use App\Models\Edition;

class EditionTest extends ModelBaseTestCase
{
    public function testEdition()
    {

        $this->factoryModelTest(Edition::class);

        $book = Book::inRandomOrder()->first();
        $months = $this->faker->numberBetween(1, 200);
        $printDate = date("Y-m-d", (strtotime("{$book->copyright} + {$months} months")));

        $nullData = [
            'book_id' => $book->id,
            'price' => $this->faker->randomFloat(2, 1, 1000),
            'qty_available' => 10,
            'print_date' => $printDate,
        ];
        $this->nullFieldNameCheck(Edition::class, $nullData);
    }
}

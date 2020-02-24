<?php

namespace Tests\Model;

use App\Models\Author;
use App\Models\Book;

class BookTest extends ModelBaseTestCase
{
    public function testBooks()
    {

        $this->factoryModelTest(Book::class);

        $nullData = [
            'author_id' => Author::inRandomOrder()->first()->id,
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'copyright' => $this->faker->date()
        ];

        $this->nullFieldNameCheck(Book::class, $nullData);


    }
}

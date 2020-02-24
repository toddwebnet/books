<?php

use App\Models\Author;
use App\Models\Book;
use App\Models\BookSales;
use App\Models\Edition;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($x = 0; $x < 10; $x++) {
            factory(Author::class)->create([]);
        }
        // add a bunch of books - and an edition for original copyright
        for ($x = 0; $x < 30; $x++) {
            $book = factory(Book::class)->create([]);
            factory(Edition::class)->create([
                'book_id' => $book->id,
                'print_date' => $book->copyright
            ]);
        }

        for ($x = 0; $x < 30; $x++) {
            factory(Edition::class)->create();
        }

        for ($x = 0; $x < 300; $x++) {
            $book = factory(BookSales::class)->create([]);        }
    }
}

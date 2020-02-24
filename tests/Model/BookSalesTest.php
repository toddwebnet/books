<?php

namespace Tests\Model;

use App\Models\BookSales;
use App\Models\Edition;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BookSalesTest extends ModelBaseTestCase
{
    public function testBookSales()
    {

        $this->factoryModelTest(BookSales::class);

        $edition = Edition::where('qty_available', '>', 0)->inRandomOrder()->first();
        $days = $this->faker->numberBetween(1, 1000);
        $saleDate = date("Y-m-d", (strtotime("{$edition->print_date} + {$days} $days")));

        $nullData = [
            'customer_first_name' => $this->faker->firstName,
            'customer_last_name' => $this->faker->lastName,
            'price' => $edition->price,
            'sale_date' => $saleDate,
        ];

        $this->nullFieldNameCheck(BookSales::class, $nullData);

        // testing for null edition
        $nullData['edition_id'] = null;
        $expected = "Null check for edition_id works";
        $actual = "";
        try {
            BookSales::create($nullData);
        } catch (ModelNotFoundException $e) {
            // expecting this because the observer is looking for a valid edition_id
            $actual = $expected;
        }
        $this->assertEquals($actual, $expected);


        // testing observer taht adds and removes
        $edition = Edition::where('qty_available', '>', 0)->inRandomOrder()->first();
        $firstCount = Edition::find($edition->id)->qty_available;
        $newEdition = factory(BookSales::class)->create([
            'edition_id' => $edition->id,
            'price' => $edition->price
        ]);
        $secondCount = Edition::find($edition->id)->qty_available;
        $this->assertEquals($firstCount - 1, $secondCount);

        $newEdition->delete();
        $thirdCount = Edition::find($edition->id)->qty_available;
        $this->assertEquals($firstCount, $thirdCount);


    }
}

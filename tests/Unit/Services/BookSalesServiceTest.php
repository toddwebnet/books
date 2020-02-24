<?php

namespace Tests\Unit\Services;

use App\Models\Edition;
use App\Services\BookSalesService;
use Tests\Model\ModelBaseTestCase;

class BookSalesServiceTest extends ModelBaseTestCase
{

    public function testBookSalesService()
    {
        $bookSaleService = new BookSalesService();

        $edition = Edition::where('qty_available', '>', 0)->inRandomOrder()->first();

        $saleDate = date("Y-m-d", strtotime(
            $edition->print_date . ' + ' . $this->faker->numberBetween(1, 10000) . ' days'
        ));
        $customerFirstName = $this->faker->firstName;
        $customerLastName = $this->faker->lastName;
        $bookSaleService->sellBook($customerFirstName, $customerLastName, $edition->id, $saleDate);

        $editionAfter = Edition::find($edition->id);
        $this->assertEquals(1,$edition->qty_available - $editionAfter->qty_available);
    }

}

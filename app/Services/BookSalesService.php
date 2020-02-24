<?php

namespace App\Services;

use App\Models\Book;
use App\Models\BookSales;
use App\Models\Edition;
use Illuminate\Support\Facades\DB;

class BookSalesService
{
    /**
     * @param $customerFirstName
     * @param $customerLastName
     * @param $editionId
     * @param $saleDate
     */
    public function sellBook($customerFirstName, $customerLastName, $editionId, $saleDate)
    {
        $edition = Edition::findOrFail($editionId);
        $saleData = [
            'edition_id' => $edition->id,
            'price' => $edition->price,
            'customer_first_name' => $customerFirstName,
            'customer_last_name' => $customerLastName,
            'sale_date' => date("Y-m-d", strtotime($saleDate))
        ];
        BookSales::create($saleData);
    }

    /**
     * big ugly sql
     *
     * @return mixed
     */
    public function listTopSoldEditions()
    {

        // right about now would be nice to have cte's in mysql


        $aggregateSQL = "
          select b.id book_id, e.id edition_id, count(*) numSold from 
          book_sales bs
          inner join editions e on e.id = bs.edition_id
          inner join books b on b.id = e.book_id and b.is_active = 1
          group by b.id, e.id
        ";

        $sql = "
        select 
        b.id book_id,
        e.sku, e.price, e.qty_available,
        a.first_name, a.last_name,
        b.title, b.description, b.copyright,
        e.print_date, ag.totalAvailable,
        numSold as maxEditionSold, totalSold
        from 
        (
        select book_id, max(numSold) maxSold
        from (
         {$aggregateSQL}
        ) b1
        group by book_id
        ) b2
        inner join (
        {$aggregateSQL}
        )b3 on b2.book_id = b3.book_id and b3.numSold = b2.maxSold
        inner join editions e on e.id = b3.edition_id
        inner join books b on b.id = e.book_id and b.is_active = 1
        inner join authors a on a.id = b.author_id 
        left outer join (
            select b.id book_id, sum(qty_available) totalAvailable, count(*) totalSold from 
              book_sales bs
            inner join editions e on e.id = bs.edition_id
            inner join books b on b.id = e.book_id and b.is_active = 1
            group by b.id
        ) ag on ag.book_id = b.id
        order by totalSold desc, numSold desc
        ";

        return DB::select($sql);
    }

    /**
     * @param Book $book
     * @return array
     */
    public function getBookSalesTotals(Book $book)
    {
        // index 0 is all
        $sales = [0 => 0];
        foreach ($book->editions as $edition) {
            foreach ($edition->sales as $sale) {
                if (!array_key_exists($edition->id, $sales)) {
                    $sales[$edition->id] = 0;
                }
                $sales[$edition->id] += $sale->price;
                $sales[0] += $sale->price;

            }
        }
        return $sales;
    }
}

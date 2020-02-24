<?php


namespace App\Models\Observers;

use App\Models\BookSales;
use App\Models\Edition;

class BookSalesObserver
{

    /**
     * get book id and save it on the fly
     *
     * @param BookSales $bookSales
     */
    public function creating(BookSales $bookSales)
    {
        $edition = Edition::findOrFail($bookSales->edition_id);
        $bookSales->book_id = $edition->book_id;
    }

    /**
     * increment qty available down
     *
     * @param BookSales $bookSales
     */
    public function created(BookSales $bookSales)
    {
        $edition = Edition::findOrFail($bookSales->edition_id);
        $edition->qty_available--;
        $edition->save();

    }

    /**
     * increment qty available up
     *
     * @param BookSales $bookSales
     */
    public function deleted(BookSales $bookSales)
    {
        $edition = Edition::findOrFail($bookSales->edition_id);
        $edition->qty_available++;
        $edition->save();
    }
}

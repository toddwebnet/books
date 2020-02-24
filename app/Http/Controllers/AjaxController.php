<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookSales;
use App\Models\Edition;
use App\Services\BookSalesService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    /**
     * returns the html for top books list with buttons
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function topBooks()
    {
        /** @var BookSalesService $bookSalesService */
        $bookSalesService = app()->make(BookSalesService::class);
        $data = [
            'topBooks' => $bookSalesService->listTopSoldEditions()
        ];
        return view('ajax.topBooks', $data);
    }

    /**
     * show book html
     *
     * @param $bookId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showBook($bookId)
    {
        $book = Book::findOrFail($bookId);

        $data = [
            'book' => $book,
            'sales' => (new BookSalesService())->getBookSalesTotals($book)
        ];
        return view('ajax.showBook', $data);
    }

    /**
     * proc for deleting a book edition sale
     *
     * @param $saleId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function deleteSale($saleId)
    {
        $sale = BookSales::findOrFail($saleId);
        $bookId = $sale->book_id;
        $sale->delete();
        return $this->showBook($bookId);
    }

    /**
     * proc for deleting a book (making inactive)
     * @param $bookId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function deleteBook($bookId)
    {
        $book = Book::findOrFail($bookId);
        $book->is_active = 0;
        $book->save();
        return $this->topBooks();

    }

    /**
     * proc for adding to book edition sales
     *
     * @param Request $request
     * @param $editionId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function purchaseBook(Request $request, $editionId)
    {

        $edition = Edition::findOrFail($editionId);
        $saleData = [
            'edition_id' => $edition->id,
            'customer_first_name' => $request->post('firstName'),
            'customer_last_name' => $request->post('lastName'),
            'price' => $edition->price,
            'sale_date' => Carbon::create(),
        ];
        $bookSales = BookSales::create($saleData);
        return $this->showBook($bookSales->book_id);
    }

    /**
     * edit a book html
     *
     * @param $bookId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editBook($bookId)
    {
        $book = Book::findOrFail($bookId);

        $data = [
            'book' => $book,
        ];
        return view('ajax.editBook', $data);
    }

    /**
     * proc for saving a book and author - author saves for all authors
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function saveBook(Request $request)
    {

        $bookId = $request->post('book_id');

        $book = Book::findOrFail($bookId);

        $book->author->first_name = $request->post('first_name');
        $book->author->last_name = $request->post('last_name');
        $book->author->save();

        $book->title = $request->post('title');
        $book->description = $request->post('description');
        $book->copyright = $request->post('copyright');
        $book->save();

        return $this->editBook($bookId);

    }
}



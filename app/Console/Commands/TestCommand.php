<?php


namespace App\Console\Commands;


use App\Models\Edition;
use App\Services\BookSalesService;
use Illuminate\Console\Command;

class TestCommand extends Command
{
    protected $signature = "test";

    public function handle()
    {
    $bookService = new BookSalesService();
    $bookService->listTopSoldEditions();
    }
}

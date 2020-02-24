<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BookSales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_sales', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('book_id');
            $table->unsignedInteger('edition_id');
            $table->string('customer_first_name', 64);
            $table->string('customer_last_name', 64);
            $table->decimal('price', 18,2);
            $table->datetime('sale_date');
            $table->timestamps();
            $table->foreign('edition_id')->references('id')->on('editions');
            $table->foreign('book_id')->references('id')->on('books');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book_sales');
    }
}

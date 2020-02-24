<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Editions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('editions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('book_id');
            $table->string('sku', 16)->unique();
            $table->decimal('price', 18,2);
            $table->integer('qty_available');
            $table->date('print_date');
            $table->timestamps();
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
        Schema::dropIfExists('editions');
    }
}

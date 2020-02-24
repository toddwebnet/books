<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// observer applied in AppServiceProvider for incrementing Edition quantity
class BookSales extends Model
{
    protected $fillable = [
        'book_id',
        'edition_id',
        'customer_first_name',
        'customer_last_name',
        'price',
        'sale_date',
    ];

    /**
     * sales belong to a book
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    /**
     * sales belong to an edition
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function edition()
    {
        return $this->belongsTo(Edition::class);
    }

}

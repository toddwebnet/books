<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Edition extends Model
{
    protected $fillable = [
        'book_id',
        'price',
        'qty_available',
        'print_date'
    ];

    /**
     * Editions belong to a book
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    /**
     * editions have sales
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sales()
    {
        return $this->hasMany(BookSales::class);
    }
}

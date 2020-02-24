<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'author_id',
        'title',
        'description',
        'copyright'
    ];

    /**
     * books have an author
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    /**
     * books have editions
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function editions()
    {
        return $this->hasMany(Edition::class);
    }

    /**
     * books have sales
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sales()
    {
        return $this->hasMany(BookSales::class);
    }

    /**
     * simple function to calculate qty available
     * although in hindsite, could have made a custom property instead (doh!)
     *
     * @return int
     */
    public function qtyAvailable()
    {
        $qty = 0;
        foreach ($this->editions as $edition) {
            $qty += $edition->qty_available;
        }
        return $qty;
    }
}

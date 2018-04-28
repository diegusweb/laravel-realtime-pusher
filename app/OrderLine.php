<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\OrderLine
 *
 * @mixin \Eloquent
 */
class OrderLine extends Model
{
    protected $guarded = ['id'];

    public function product () {
        return $this->belongsTo(Product::class);
    }
}

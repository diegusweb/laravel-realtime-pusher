<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Promotion
 *
 * @mixin \Eloquent
 */
class Promotion extends Model
{
    protected $fillable = ['product_id', 'price', 'ends_at'];

    protected $with = ['product'];

    public function product () {
        return $this->belongsTo(Product::class);
    }
}

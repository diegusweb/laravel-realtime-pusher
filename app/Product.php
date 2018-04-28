<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Product
 *
 * @mixin \Eloquent
 */
class Product extends Model
{
	use SoftDeletes;

    protected $fillable = ['name', 'description', 'price', 'image'];

    public function promotion () {
        return $this->hasOne(Promotion::class);
    }
}

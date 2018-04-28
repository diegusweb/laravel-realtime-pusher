<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Order
 *
 * @mixin \Eloquent
 */
class Order extends Model
{
    const PENDING = 'PENDING';
    const PROCESSING = 'PROCESSING';
    const FINISHED = 'FINISHED';

    protected $fillable = ['user_id', 'total', 'status'];

    public function orderLines () {
        return $this->hasMany(OrderLine::class);
    }
}

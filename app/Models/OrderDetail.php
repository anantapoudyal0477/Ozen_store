<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table="order_details";
    protected $fillable = [
        'order_id', 'full_name', 'email', 'phone',
        'address', 'city', 'payment_method'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}

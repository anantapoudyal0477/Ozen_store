<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
     protected $table="order_items";

    protected $fillable = [
        'order_id',
        'product_id',
        'eye_lens_id',
        'quantity',
        'isPrescription'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id');
    }

    public function eyeLens()
    {
        return $this->belongsTo(EyeLens::class, 'eye_lens_id');
    }
}

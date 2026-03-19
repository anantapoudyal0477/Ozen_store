<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Products;
use App\Models\PrescriptionGlasses;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $fillable = [
        'user_id',
        'order_number',
        'quantity',
        'total_price',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderDetail()
    {
        return $this->hasOne(OrderDetail::class, 'order_id');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }

    // ✅ Prescription relationship (normalized)
    public function prescriptions()
    {
        // Order → hasMany prescriptions
        return $this->hasMany(\App\Models\prescriptions::class, 'order_id');
    }
}


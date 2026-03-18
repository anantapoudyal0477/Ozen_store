<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prescriptions extends Model
{
    protected $table = 'prescriptions'; // Ensure table name is correct

    protected $fillable = ['order_id', 'product_id', 'user_id', 'pd'];

    // Correct relation to PrescriptionGlasses
    public function eyes()
    {
        return $this->hasMany(PrescriptionGlasses::class, 'prescription_id', 'id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function glasses()
{
    return $this->hasMany(PrescriptionGlasses::class, 'prescription_id');
}

}

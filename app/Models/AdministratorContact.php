<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdministratorContact extends Model
{
   protected $fillable = [
        'administrator_id',
        'phone',
        'address',
        'city',
        'country',
    ];

    protected $casts = [
        'phone' => 'encrypted',
        'address' => 'encrypted',
    ];

    public function detail()
    {
        return $this->belongsTo(AdministratorDetail::class, 'administrator_id');
    }
}

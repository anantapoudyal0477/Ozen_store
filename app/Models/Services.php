<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    /** @use HasFactory<\Database\Factories\ServicesFactory> */
    use HasFactory;
        protected $table = 'services';
    protected $fillable = ['name', 'description'];
    protected $casts = [
        'name' => 'encrypted',
        'description' => 'encrypted',
        'price' => 'decimal:2',
    ];
}

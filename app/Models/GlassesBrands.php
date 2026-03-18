<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GlassesBrands extends Model
{
 /** @use HasFactory<\Database\Factories\GlassesBrandsFactory> */
    use HasFactory;
    protected $table = 'glassesBrands';
        protected $fillable = ['name'];
    protected $casts = [
        'name' => 'encrypted',
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];
}

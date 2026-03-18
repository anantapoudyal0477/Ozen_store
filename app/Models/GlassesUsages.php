<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GlassesUsages extends Model
{
    /** @use HasFactory<\Database\Factories\GlassesUsagesFactory> */
    use HasFactory;
        protected $table = 'glassesUsages';
        protected $fillable = ['name'];
    protected $casts = [
        'name' => 'encrypted',
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];
}

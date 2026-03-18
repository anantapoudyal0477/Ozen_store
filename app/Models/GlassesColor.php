<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GlassesColor extends Model
{

    /** @use HasFactory<\Database\Factories\GlassesColorFactory> */
    use HasFactory;
    protected $table = 'glasses_colors';
        protected $fillable = ['name'];
    protected $casts = [
        'name' => 'string',
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];
}

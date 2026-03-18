<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accessories extends Model
{
    /** @use HasFactory<\Database\Factories\AccessoriesFactory> */
    use HasFactory;
    protected $table = 'accessories';
    protected $fillable = ['name'];
    protected $casts = [
        // 'name' => 'encrypted',
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

}

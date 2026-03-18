<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Copyright extends Model
{
    /** @use HasFactory<\Database\Factories\CopyrightFactory> */
    use HasFactory;

    protected $table = 'copyrights';
    protected $fillable = [
        'copyrights_name',
        'copyrights_description',
    ];
    protected $casts = [
        'copyrights_name'=>'encrypted',
        'copyrights_description' => 'encrypted',
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];
}

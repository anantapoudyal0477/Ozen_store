<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Navigation extends Model
{
    use HasFactory;
    protected $table = "navigations";
protected $fillable = [
    'name',
    'route_name',
    'url',
    'order',
    'icon',
    'is_active',
    'target'
];

    protected $casts = [
        'nav_name'=>'encrypted',
        'nav_URL'=>'encrypted',
        'nav_URL_position'=>'encrypted',
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];
}

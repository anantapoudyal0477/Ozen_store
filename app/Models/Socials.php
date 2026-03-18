<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Socials extends Model
{
    /** @use HasFactory<\Database\Factories\SocialsFactory> */
    use HasFactory;
    protected $table = "socials";
    protected $fillable = ['social_platform_name', 'social_platform_link'];
    protected $casts = [
        'social_platform_name'=>'encrypted',
        'social_platform_link'=>'encrypted',
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];
}

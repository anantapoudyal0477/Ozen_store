<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ViewerHomeHero extends Model
{
    protected $table='viewer_home_heroes';
    protected $casts = [
        'title'=>'encrypted',
        'subtitle'=>'encrypted',
        'description'=>'encrypted',
        'background_image'=>'encrypted',
        'badge_text'=>'encrypted',
        'stats'=>'array'
    ];
}

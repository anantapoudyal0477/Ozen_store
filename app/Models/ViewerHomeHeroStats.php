<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ViewerHomeHeroStats extends Model
{
    protected $table='viewer_home_hero_stats';
    protected $casts=[
        'label'=>'encrypted',
        'value'=>'encrypted'
    ];

}

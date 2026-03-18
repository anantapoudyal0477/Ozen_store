<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ViewerHomeFeatures extends Model
{
    protected $table='viewer_home_features';
    protected $casts=[
        'title'=>'encrypted',
        'description'=>'encrypted',
        'icon_svg'=>'encrypted',
        'bg_gradient_from'=>'encrypted',
        'bg_gradient_to'=>'encrypted',
        'order_index'=>'integer',

    ];
}

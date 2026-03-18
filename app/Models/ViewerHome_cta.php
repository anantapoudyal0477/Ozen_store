<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ViewerHome_cta extends Model
{
    protected $table = 'viewer_home_ctas';
    protected $casts =[
        'heading'=>'encrypted',
        'description'=>'encrypted',
        'button_text'=>'encrypted',
        'button_link'=>'encrypted',

    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminNavigationLinks extends Model
{
    /** @use HasFactory<\Database\Factories\AdminNavigationLinksFactory> */
    use HasFactory;
    protected $table = 'admin_navigation_links';
    protected $fillable = ['name','route_name', 'url', 'group', 'top'];
    protected $casts = [
        'name' => 'encrypted',
        'route_name'=>'string',
      'url' => 'string',
        'group' => 'string',

        'top' => 'boolean',
    ];


}

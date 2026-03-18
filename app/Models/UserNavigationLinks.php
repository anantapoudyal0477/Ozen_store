<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserNavigationLinks extends Model
{
use HasFactory;

    protected $table = 'user_navigation_links';

    protected $fillable = [
        'name', 'route_name', 'url', 'icon',
        'order', 'is_active', 'target',
    ];

    // 🔹 Scope to get only active links
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // 🔹 Scope to get links in proper order
    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
      protected $fillable = ['name', 'description'];

    public function administrators()
    {
        return $this->belongsToMany(Administrator::class, 'administrator_roles');
    }
}

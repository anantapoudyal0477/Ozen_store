<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdministratorDetail extends Model
{
    //
   protected $fillable = [
        'administrator_id',
        'designation',
        'profile_photo',
    ];

    public function administrator()
    {
        return $this->belongsTo(Administrator::class);
    }

    public function contacts()
    {
        return $this->hasMany(AdministratorContact::class, 'administrator_id');
    }
}

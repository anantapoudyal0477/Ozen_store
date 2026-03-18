<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Doctor extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\DoctorFactory> */
   use Notifiable;

    protected $fillable = [
        'doctor_code', 'name', 'email', 'password', 'contact_number', 'status'
    ];

    protected $hidden = ['password'];

    public function profile()
    {
        return $this->hasOne(DoctorDetail::class);
    }

    public function license()
    {
        return $this->hasOne(DoctorLicenses::class);
    }

    public function schedules()
    {
        return $this->hasMany(DoctorSchedules::class);
    }

}

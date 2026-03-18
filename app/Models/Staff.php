<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // For authentication
use Illuminate\Notifications\Notifiable;
use App\Models\StaffDetail;
use App\Models\StaffAttendance;

class Staff extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'staff';

    protected $fillable = [
        'staff_code',
        'email',
        'password',
        'contact_number',
    ];

    protected $hidden = [
        'password',
    ];

    // Relationships
    public function details()
    {
        return $this->hasOne(StaffDetail::class);
    }

    public function attendances()
    {
        return $this->hasMany(StaffAttendance::class);
    }

    // Dynamic shift_end based on month
    public function getShiftEndAttribute()
    {
        $month = now()->month;
        return ($month >= 3 && $month <= 9) ? '18:00:00' : '17:00:00';
    }
}

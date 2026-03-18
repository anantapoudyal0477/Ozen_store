<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorLicenses extends Model
{
    /** @use HasFactory<\Database\Factories\DoctorLicensesFactory> */
    use HasFactory;
    protected $table = 'doctor_licenses';
     protected $fillable = ['doctor_id','license_number','expiry_date'];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}

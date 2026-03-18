<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorDetail extends Model
{
    /** @use HasFactory<\Database\Factories\DoctorDetailFactory> */
    use HasFactory;

    protected $table = 'doctor_details';
   protected $fillable = [
        'doctor_id','designation','qualification','experience_years','specialization','consultation_fee','photo_url'
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}

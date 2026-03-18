<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorSchedules extends Model
{
    /** @use HasFactory<\Database\Factories\DoctorSchedulesFactory> */
    use HasFactory;
    protected $table = 'doctor_schedules';

     protected $fillable = ['doctor_id','working_days','start_time','end_time','status'];

    protected $casts = [
        'working_days' => 'array',
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}

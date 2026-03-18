<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class StaffAttendance extends Model
{
    use HasFactory;

    protected $table = 'staff_attendance';

    protected $fillable = [
        'staff_id',
        'date',
        'actual_checkout',
        'overtime_hours',
    ];

    protected $casts = [
        'date' => 'date',
        'actual_checkout' => 'datetime:H:i:s',
    ];

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }

    // Automatically calculate overtime on save
    protected static function booted()
    {
        static::saving(function ($attendance) {
            if ($attendance->actual_checkout) {
                $shiftEnd = Carbon::parse($attendance->staff->shift_end);
                $checkout = Carbon::parse($attendance->actual_checkout);

                $attendance->overtime_hours = max(
                    0,
                    round($checkout->diffInSeconds($shiftEnd) / 3600, 2)
                );
            }
        });
    }
}

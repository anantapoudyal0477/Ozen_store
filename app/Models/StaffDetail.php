<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffDetail extends Model
{
    use HasFactory;

    protected $table = 'staff_details';

    protected $fillable = [
        'staff_id',
        'role',
        'department',
        'shift_start',
    ];

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrescriptionGlasses extends Model
{
    protected $fillable = [
        'prescription_id',
        'eye',
        'sphere',
        'cylinder',
        'axis'
    ];

    public function prescription()
    {
        return $this->belongsTo(prescriptions::class, 'prescription_id','id ');
    }
}

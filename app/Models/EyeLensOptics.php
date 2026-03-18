<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EyeLensOptics extends Model
{
    use HasFactory;

    protected $fillable = ['eye_lens_id', 'sphere', 'cylinder', 'axis', 'add_power'];

    protected $casts = [
        'sphere' => 'decimal:2',
        'cylinder' => 'decimal:2',
        'axis' => 'integer',
        'add_power' => 'decimal:2',
    ];

    public function lens() {
        return $this->belongsTo(EyeLens::class, 'eye_lens_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EyeLensDimensions extends Model
{
    use HasFactory;

    protected $fillable = ['eye_lens_id', 'base_curve', 'diameter', 'water_content', 'oxygen_permeability'];

    protected $casts = [
        'base_curve' => 'decimal:2',
        'diameter' => 'decimal:2',
        'water_content' => 'decimal:2',
    ];

    public function lens() {
        return $this->belongsTo(EyeLens::class, 'eye_lens_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EyeLensFeatures extends Model
{
    use HasFactory;

    protected $fillable = ['eye_lens_id', 'color_id', 'uv_protection'];

    protected $casts = [
        'uv_protection' => 'boolean',
    ];

    public function lens() {
        return $this->belongsTo(EyeLens::class, 'eye_lens_id');
    }
    public function color() {
        return $this->hasOne(GlassesColor::class,'color_id');
    }
}

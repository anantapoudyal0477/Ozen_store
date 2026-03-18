<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class wearingReplacements extends Model
{
    /** @use HasFactory<\Database\Factories\WearingReplacementsFactory> */
    use HasFactory;
    protected $table = 'wearing_replacements';
     protected $fillable = [
        'replacement_cycle',
        'wearing_schedule'
    ];

    protected $casts = [
        'replacement_cycle' => 'string',
        'wearing_schedule' => 'string',
    ];

    public function eyeLenses() {
        return $this->hasMany(EyeLens::class);
    }
}

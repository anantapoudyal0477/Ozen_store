<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EyeLensType extends Model
{
    /** @use HasFactory<\Database\Factories\EyeLensTypeFactory> */
    use HasFactory;
     use HasFactory;

    protected $fillable = ['type_name', 'description'];

    protected $casts = [
        'type_name' => 'encrypted',
        'description' => 'encrypted',
    ];

    public function eyeLenses()
    {
        return $this->hasMany(EyeLens::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EyeLensStockPrices extends Model
{
    use HasFactory;

    protected $fillable = ['eye_lens_id', 'price', 'stock'];

    protected $casts = [
        'price' => 'decimal:2',
        'stock' => 'integer',
    ];

    public function lens() {
        return $this->belongsTo(EyeLens::class, 'eye_lens_id');
    }
}

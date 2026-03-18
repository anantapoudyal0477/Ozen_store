<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EyeLens extends Model
{
    use HasFactory;

    protected $table = 'eye_lenses';
    protected $fillable = [
        'lens_name', 'lens_type_id', 'wearing_replacement_id', 'brand_id', 'material_id', 'user_id'
    ];

    // Relationships
    public function lensType() {
        return $this->belongsTo(EyeLensType::class);
    }

    public function wearingReplacement() {
        return $this->belongsTo(WearingReplacements::class);
    }

    public function brand() {
        return $this->belongsTo(Brand::class);
    }

    public function material() {
        return $this->belongsTo(Materials::class);
    }

    public function optics() {
        return $this->hasOne(EyeLensOptics::class);
    }

    public function dimensions() {
        return $this->hasOne(EyeLensDimensions::class);
    }

    public function features() {
        return $this->hasOne(EyeLensFeatures::class);
    }

    public function stockPrice() {
        return $this->hasOne(EyeLensStockPrices::class);
    }
}

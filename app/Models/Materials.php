<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materials extends Model
{
    /** @use HasFactory<\Database\Factories\MaterialsFactory> */
    use HasFactory;
    protected $table = 'materials';

    protected $fillable = ['name', 'product_type_id'];

    public function productType() {
        return $this->belongsTo(ProductTypes::class);
    }

    public function eyeLenses() {
        return $this->hasMany(EyeLens::class);
    }
    protected $casts = [

        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];
}

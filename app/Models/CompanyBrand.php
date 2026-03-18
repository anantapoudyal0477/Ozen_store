<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyBrand extends Model
{
    /** @use HasFactory<\Database\Factories\CompanyBrandFactory> */
    use HasFactory;
    protected $table = "company_brands";
    protected $fillable = ['company_brand_name', 'company_brand_logo','company_brand_description'];
    protected $casts = [
        'company_brand_name'=>'encrypted',
        'company_brand_logo'=>'encrypted',
        'company_brand_description'=>'encrypted',
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];
}

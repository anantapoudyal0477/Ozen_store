<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CompanyBrand;

class CompanyBrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
  public function run(): void
    {
        $brandData = [
            ["company_brand_name" => "OZEN Eyewear", "company_brand_logo" => "assets\\Images\\BrandLogo\\BrandLogo.jfif", "company_brand_description" => "OZEN Eyewear is dedicated to providing stylish, high-quality eyewear that combines comfort, durability, and modern design. From prescription glasses to trendy sunglasses, we help you see the world clearly while expressing your unique style."],
        ];
        foreach ($brandData as $brand) {
            CompanyBrand::create($brand); // triggers encryption & timestamps
        }

    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CompanyBrand;
use App\Models\Copyright;
use Illuminate\Support\Facades\Log;

class CopyrightSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
     public function run(): void
    {
        try {
            // Get brand name safely
            $brand = CompanyBrand::first();
            $brandName = $brand ? e($brand->company_brand_name) : 'OZEN';

            // Define copyright entry
            $copyrightData = [
                "copyrights_name" => "copyright",
                "copyrights_description" => "© " . now()->year . " " . $brandName . " All rights reserved",
                "year" => now()->year,
            ];

            // Prevent duplicates (update or create)
            Copyright::updateOrCreate(
                ['year' => $copyrightData['year']], // unique by year
                $copyrightData
            );

            Log::info("CopyrightSeeder executed successfully.");
        } catch (\Exception $e) {
            Log::error("Error in CopyrightSeeder: " . $e->getMessage());
        }
    }
}

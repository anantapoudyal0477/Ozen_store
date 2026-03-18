<?php

namespace Database\Seeders;

use App\Models\SubCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Categories;
use App\Models\GlassesColor;
use App\Models\GlassesStyles;
use App\Models\GlassesUsages;
use App\Models\Accessories;
use App\Models\Brand;
use App\Models\ProductTypes;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = ['Safety glasses','Sunglasses', 'Prescription Glasses', 'Reading Glasses', 'Blue Light Blocking Glasses', 'Sports Glasses', 'Safety Glasses', 'Fashion Glasses', 'Kids Glasses'];
        $subcategories = ['Aviator', 'Wayfarer', 'Round', 'Cat Eye', 'Square', 'Oval', 'Rimless', 'Geometric'];
        $glasses_types = ['Full Rim', 'Half Rim', 'Rimless'];
        $styles = ['Classic', 'Modern', 'Vintage', 'Sporty', 'Trendy'];
        $colors = ['Black', 'Brown', 'Tortoise', 'Blue', 'Red', 'Green', 'Clear', 'Gold', 'Silver'];
        $glasses_uses = ['Everyday Wear', 'Outdoor Activities', 'Sports', 'Reading', 'Computer Use', 'Driving', 'Fashion Statement'];
        $glasses_types = ['glasses','accessories'];
        $accessories = ['Cleaning Cloth', 'Protective Case', 'Lens Cleaner', 'Anti-Fog Spray', 'Adjustable Nose Pads', 'Replacement Screws'];
        foreach ($categories as $category) {
            Categories::create(['name' => $category]);
        }
        foreach($subcategories as $scategories){
            SubCategory::create(['name'=>$scategories]);
        }
         foreach ($glasses_types as $type) {
            ProductTypes::create(['name' => $type]);
        }



        foreach ($styles as $style) {
            GlassesStyles::create(['name' => $style]);
        }

        foreach ($colors as $color) {
            GlassesColor::create(['name' => $color]);
        }



        foreach ($glasses_uses as $use) {
            GlassesUsages::create(['name' => $use]);
        }

        foreach ($accessories as $accessory) {
            Accessories::create(['name' => $accessory]);
        }
    }
}

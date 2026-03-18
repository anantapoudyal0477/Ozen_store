<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\GlassesBrands;

class GlassesBrandsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $glassBrandsNames = [
            ['name'=>'Ray-Ban'],
            ['name'=>'Oakley'],
            ['name'=>'Gucci'],
            ['name'=>'Prada'],
            ['name'=>'Versace'],
            ['name'=>'Armani'],
            ['name'=>'Burberry'],
            ['name'=>'Dolce & Gabbana'],
            ['name'=>'Tom Ford'],
            ['name'=>'Michael Kors'],
            ['name'=>'Coach'],
            ['name'=>'Maui Jim'],
            ['name'=>'Costa Del Mar'],
            ['name'=>'Persol'],
            ['name'=>'Silhouette'],
            ['name'=>'Kate Spade'],
            ['name'=>'Tiffany & Co.'],
            ['name'=>'Fendi'],
            ['name'=>'Dior'],
            ['name'=>'Chanel']
        ];
        foreach ($glassBrandsNames as $name) {
            GlassesBrands::create($name);
        }
    }
}

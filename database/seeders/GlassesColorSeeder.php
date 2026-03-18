<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\GlassesColor;

class GlassesColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $glassesColorNames = [
            ['name'=>'Black'],
            ['name'=>'Brown'],
            ['name'=>'Tortoise'],
            ['name'=>'Blue'],
            ['name'=>'Green'],
            ['name'=>'Red'],
            ['name'=>'Pink'],
            ['name'=>'Purple'],
            ['name'=>'Yellow'],
            ['name'=>'Orange'],
            ['name'=>'Gray'],
            ['name'=>'Silver'],
            ['name'=>'Gold'],
            ['name'=>'Rose Gold'],
            ['name'=>'Matte Black'],
            ['name'=>'Matte Brown'],
            ['name'=>'Transparent/Clear'],
            ['name'=>'Gradient'],
            ['name'=>'Mirrored'],
            ['name'=>'Photochromic/Transition']
        ];
        foreach ($glassesColorNames as $name) {
            GlassesColor::create($name);
        }
    }
}

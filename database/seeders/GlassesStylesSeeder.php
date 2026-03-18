<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\GlassesStyles;

class GlassesStylesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $glassesStylesNames = [
            ['name'=>'Aviator'],
            ['name'=>'Wayfarer'],
            ['name'=>'Round'],
            ['name'=>'Cat Eye'],
            ['name'=>'Square'],
            ['name'=>'Rectangle'],
            ['name'=>'Oval'],
            ['name'=>'Geometric'],
            ['name'=>'Browline'],
            ['name'=>'Clubmaster'],
            ['name'=>'Shield'],
            ['name'=>'Wraparound'],
            ['name'=>'Rimless'],
            ['name'=>'Semi-Rimless'],
            ['name'=>'Sporty'],
            ['name'=>'Vintage'],
            ['name'=>'Oversized'],
            ['name'=>'Butterfly'],
            ['name'=>'Heart-shaped'],
            ['name'=>'Keyhole']
        ];
        foreach ($glassesStylesNames as $name) {
            GlassesStyles::create($name);
        }
    }
}

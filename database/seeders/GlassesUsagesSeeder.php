<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\GlassesUsages;

class GlassesUsagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $glassesUsagesNames = [
            ['name'=>'Prescription'],
            ['name'=>'Reading'],
            ['name'=>'Sunglasses'],
            ['name'=>'Blue Light Blocking'],
            ['name'=>'Sports/Activewear'],
            ['name'=>'Safety/Protective'],
            ['name'=>'Fashion/Non-prescription'],
            ['name'=>'Computer/Screen Use'],
            ['name'=>'Driving'],
            ['name'=>'Outdoor Activities']
        ];
        foreach ($glassesUsagesNames as $name) {
            GlassesUsages::create($name);
        }
    }
}

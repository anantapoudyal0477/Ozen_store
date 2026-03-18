<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Accessories;

class AccessoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $Accessories = [
            ['name' => 'Cleaning Cloth'],
            ['name' => 'Protective Case'],
            ['name' => 'Lens Cleaner Spray'],
            ['name' => 'Anti-Fog Wipes'],
            ['name' => 'Sunglass Strap'],
            ['name' => 'Eyeglass Repair Kit'],
            ['name' => 'Blue Light Blocking Clip-ons'],
            ['name' => 'Nose Pads'],
            ['name' => 'Eyeglass Chains'],
            ['name' => 'Travel Pouch'],
        ];
        foreach ($Accessories as $accessory) {
            Accessories::create($accessory);
        }

    }
}

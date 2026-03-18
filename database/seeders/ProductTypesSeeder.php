<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProductTypes;

class ProductTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productTypes = [
            ['name'=>'Glasses'],
            ['name'=>'Eye Lenses'],

        ];

        foreach ($productTypes as $type) {
            ProductTypes::create($type);
        }
    }
}

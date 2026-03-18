<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ViewerHomeHeroStats;

class ViewerHomeHeroStatsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $stats = [
            ['label' => 'Unique Styles', 'value' => '500+', 'order_index' => 1],
            ['label' => 'Happy Customers', 'value' => '50K+', 'order_index' => 2],
            ['label' => 'Customer Rating', 'value' => '4.9★', 'order_index' => 3],
        ];

        foreach ($stats as $data) {
            ViewerHomeHeroStats::create($data);
        }
    }
}

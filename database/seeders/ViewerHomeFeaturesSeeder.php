<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ViewerHomeFeatures;

class ViewerHomeFeaturesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $HomeFeatureData =
        [[
            'title' => 'Premium Quality',
            'description' => 'Handcrafted frames using the finest materials for lasting durability and comfort.',
            'icon_svg' => '<svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                        </svg>',
            'bg_gradient_from' => 'blue',
            'bg_gradient_to' => 'indigo',
            'order_index' => 1
        ],[
            'title' => 'Perfect Vision',
            'description' => 'Advanced lens technology for crystal-clear vision and optimal eye protection.',
            'icon_svg' => '<svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>',
            'bg_gradient_from' => 'purple',
            'bg_gradient_to' => 'pink',
            'order_index' => 2
        ],[
            'title' => 'Stylish Designs',
            'description' => 'Trending frames that complement your unique personality and lifestyle.',
            'icon_svg' => ' <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>',
            'bg_gradient_from' => 'green',
            'bg_gradient_to' => 'emerald',
            'order_index' => 3
        ]];
        foreach($HomeFeatureData as $data){
            ViewerHomeFeatures::create($data);
        }
    }
}

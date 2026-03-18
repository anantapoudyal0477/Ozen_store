<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\ViewerHomeHero;
class ViewerHomeHeroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $HomeHeroData = [[
            'title' => 'See the World',
            'subtitle' => 'With Clarity',
            'description' => 'Discover premium eyewear that combines timeless style with cutting-edge technology.',
            'background_image' => 'assets/images/homepage/eyeglasses-hero.jpg',
            'badge_text' => 'New Collection 2025',
            'stats' => [
                ['label' => 'Unique Styles', 'value' => '500+'],
                ['label' => 'Happy Customers', 'value' => '50K+'],
                ['label' => 'Customer Rating', 'value' => '4.9★']
            ]
        ]];
        foreach($HomeHeroData as $data){
            ViewerHomeHero::create($data);
        }
    }
}

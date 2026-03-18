<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ViewerHome_cta;


class ViewerHomeCtaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $CTA_Data =        [[
            'heading' => 'Ready to Find Your Perfect Frame?',
            'description' => 'Browse our curated collection and discover eyewear that\'s uniquely you.',
            'button_text' => 'Explore Collection',
            'button_link' => route('Products.index')
        ]];
        foreach($CTA_Data as $data){
            ViewerHome_cta::create($data);
        }
    }
}

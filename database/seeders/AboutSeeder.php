<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\About;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $aboutData = [
             [
                'about_topic_title'       => 'Our Story',
                'about_topic_description' => 'At Our Eyeglasses Shop, we are passionate about your vision. We offer a wide range of stylish frames, sunglasses, and prescription lenses to help you see clearly and look great.',
                'created_at'              => now(),
                'updated_at'              => now(),
            ],
            [
                'about_topic_title'       => 'Our Mission',
                'about_topic_description' => 'To deliver stylish, affordable, and high-quality eyeglasses while ensuring excellent eye care for our customers.',
                'created_at'              => now(),
                'updated_at'              => now(),
            ],
            [
                'about_topic_title'       => 'Our Vision',
                'about_topic_description' => 'To be the leading eyeglasses shop, providing high-quality eyewear and exceptional customer service.',
                'created_at'              => now(),
                'updated_at'              => now(),
            ],
            [
                'about_topic_title'       => 'Why Choose Us',
                'about_topic_description' => 'We offer a wide selection of frames, expert eye care services, and a commitment to customer satisfaction.',
                'created_at'              => now(),
                'updated_at'              => now(),
            ],
        ];
        foreach ($aboutData as $data) {
            About::create($data);
        }
    }
}

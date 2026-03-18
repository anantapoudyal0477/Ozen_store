<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Products;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $eyeglasses_data = [
            [
                'product_name' => 'Classic Aviator Sunglasses',
                'product_description' => 'Timeless aviator design with UV protection lenses.',
                'product_price' => 120.00,
                'product_image' => 'assets/Images/Glasses/aviator1.avif',
                'product_stock' => 50
            ],
                        [
                'product_name' => 'Classic Aviator Sunglasses',
                'product_description' => 'Timeless aviator design with UV protection lenses.',
                'product_price' => 120.00,
                'product_image' => 'assets/Images/Glasses/aviator2.jpg',
                'product_stock' => 50
            ],
            [
                'product_name' => 'Retro Round Glasses',
                'product_description' => 'Vintage-inspired round frames for a stylish look.',
                'product_price' => 85.00,
                'product_image' => 'assets/Images/Glasses/round.jpeg',
                'product_stock' => 30
            ],
            [
                'product_name' => 'Sporty Wraparound Shades',
                'product_description' => 'Perfect for outdoor activities with a secure fit.',
                'product_price' => 95.00,
                'product_image' => 'assets/Images/Glasses/wraparound.webp',
                'product_stock' => 20
            ],
            [
                'product_name' => 'Elegant Cat-Eye Glasses',
                'product_description' => 'Chic cat-eye frames for a fashionable statement.',
                'product_price' => 110.00,
                'product_image' => 'assets/Images/Glasses/cateye.jpg',
                'product_stock' => 15
            ],
            [
                'product_name' => 'Modern Square Frames',
                'product_description' => 'Sleek square design suitable for all occasions.',
                'product_price' => 100.00,
                'product_image' => 'assets/Images/Glasses/square.jpg',
                'product_stock' => 25
            ],

        ];
        foreach($eyeglasses_data as $data){
            Products::create($data);
        }
    }
}

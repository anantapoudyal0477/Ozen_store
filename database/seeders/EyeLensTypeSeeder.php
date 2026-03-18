<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\EyeLensType;

class EyeLensTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $types = [
            ['type_name'=>'Powered', 'description'=>'Corrective lenses for vision power'],
            ['type_name'=>'Powerless', 'description'=>'Zero power cosmetic lenses'],
            ['type_name'=>'Toric', 'description'=>'For astigmatism correction'],
            ['type_name'=>'Multifocal', 'description'=>'For presbyopia or multiple vision'],
            ['type_name'=>'Colored', 'description'=>'Cosmetic color lenses'],
            ['type_name'=>'Scleral', 'description'=>'Large lenses covering entire cornea'],
            ['type_name'=>'Hybrid', 'description'=>'Rigid center with soft skirt'],
            ['type_name'=>'Daily Disposable', 'description'=>'Use once and discard daily'],
            ['type_name'=>'Extended Wear', 'description'=>'Can be worn for multiple days'],
            ['type_name'=>'Soft', 'description'=>'Soft lenses for comfort'],
        ];

        foreach($types as $type){
            EyeLensType::create($type);
        }
    }
}

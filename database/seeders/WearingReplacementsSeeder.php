<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\WearingReplacements;

class WearingReplacementsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $options = [
            ['replacement_cycle'=>'Daily','wearing_schedule'=>'Daily Wear'],
            ['replacement_cycle'=>'Daily','wearing_schedule'=>'Extended Wear'],
            ['replacement_cycle'=>'Biweekly','wearing_schedule'=>'Daily Wear'],
            ['replacement_cycle'=>'Biweekly','wearing_schedule'=>'Extended Wear'],
            ['replacement_cycle'=>'Monthly','wearing_schedule'=>'Daily Wear'],
            ['replacement_cycle'=>'Monthly','wearing_schedule'=>'Extended Wear'],
            ['replacement_cycle'=>'Yearly','wearing_schedule'=>'Daily Wear'],
            ['replacement_cycle'=>'Yearly','wearing_schedule'=>'Extended Wear'],
            ['replacement_cycle'=>'Monthly','wearing_schedule'=>'Extended Wear'],
            ['replacement_cycle'=>'Biweekly','wearing_schedule'=>'Extended Wear'],
        ];

        foreach($options as $option){
            WearingReplacements::create($option);
        }
    }
}

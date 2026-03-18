<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $SettingData=[
            ["setting_name"=>"","setting_description"=>""]
        ];
        foreach($SettingData as $data){

            Setting::create($data);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\EyeLens;

class EyeLensSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $lenses = [
            ['lens_name'=>'AquaSoft Daily','lens_type_id'=>1,'wearing_replacement_id'=>1,'brand_id'=>1,'sphere'=>'-2.50','base_curve'=>'8.6','diameter'=>'14.2','price'=>1200],
            ['lens_name'=>'Bella Hazel','lens_type_id'=>2,'wearing_replacement_id'=>2,'brand_id'=>2,'sphere'=>null,'base_curve'=>'8.7','diameter'=>'14.5','price'=>1800],
            ['lens_name'=>'Toric Clear','lens_type_id'=>3,'wearing_replacement_id'=>3,'brand_id'=>3,'sphere'=>'-1.75','cylinder'=>'-0.75','axis'=>180,'base_curve'=>'8.6','diameter'=>'14.0','price'=>1500],
            ['lens_name'=>'Multifocal Comfort','lens_type_id'=>4,'wearing_replacement_id'=>4,'brand_id'=>4,'sphere'=>'+1.50','add_power'=>+2.00,'base_curve'=>'8.6','diameter'=>'14.2','price'=>2000],
            ['lens_name'=>'Color Pop Blue','lens_type_id'=>5,'wearing_replacement_id'=>5,'brand_id'=>5,'sphere'=>null,'base_curve'=>'8.5','diameter'=>'14.2','price'=>1700],
            ['lens_name'=>'Scleral Pro','lens_type_id'=>6,'wearing_replacement_id'=>6,'brand_id'=>6,'sphere'=>'-3.00','base_curve'=>'8.9','diameter'=>'15.0','price'=>2500],
            ['lens_name'=>'Hybrid Vision','lens_type_id'=>7,'wearing_replacement_id'=>7,'brand_id'=>7,'sphere'=>'-2.25','base_curve'=>'8.7','diameter'=>'14.3','price'=>2200],
            ['lens_name'=>'Daily Comfort','lens_type_id'=>8,'wearing_replacement_id'=>8,'brand_id'=>8,'sphere'=>'-1.00','base_curve'=>'8.5','diameter'=>'14.0','price'=>1200],
            ['lens_name'=>'Extended Wear Plus','lens_type_id'=>9,'wearing_replacement_id'=>9,'brand_id'=>9,'sphere'=>'-2.50','base_curve'=>'8.6','diameter'=>'14.2','price'=>2000],
            ['lens_name'=>'Soft Vision','lens_type_id'=>10,'wearing_replacement_id'=>10,'brand_id'=>10,'sphere'=>'-1.50','base_curve'=>'8.5','diameter'=>'14.0','price'=>1500],
        ];

        foreach($lenses as $lens){
            EyeLens::create($lens);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PrescriptionGlasses;

class PrescriptionGlassesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $prescriptionsData = [
            [
                'user_id' => 1,
                'left_sphere' => -2.50,
                'right_sphere' => -2.75,
                'left_cylinder' => -0.50,
                'right_cylinder' => -0.75,
                'left_axis' => 90,
                'right_axis' => 80,
                'pd' => 62,
            ],
            [
                'user_id' => 2,
                'left_sphere' => -1.25,
                'right_sphere' => -1.50,
                'left_cylinder' => 0.00,
                'right_cylinder' => -0.25,
                'left_axis' => null,
                'right_axis' => 110,
                'pd' => 60,
            ],
            [
                'user_id' => 3,
                'left_sphere' => -3.75,
                'right_sphere' => -4.00,
                'left_cylinder' => -1.25,
                'right_cylinder' => -1.00,
                'left_axis' => 45,
                'right_axis' => 50,
                'pd' => 65,
            ],
            [
                'user_id' => 4,
                'left_sphere' => +1.50,   // farsighted
                'right_sphere' => +1.75,
                'left_cylinder' => -0.50,
                'right_cylinder' => -0.75,
                'left_axis' => 120,
                'right_axis' => 130,
                'pd' => 59,
            ],
            [
                'user_id' => 5,
                'left_sphere' => -0.75,
                'right_sphere' => -1.00,
                'left_cylinder' => -0.50,
                'right_cylinder' => -0.25,
                'left_axis' => 95,
                'right_axis' => 100,
                'pd' => 63,
            ],
        ];

        foreach ($prescriptionsData as $data) {
            PrescriptionGlasses::create($data);
        }
    }
}

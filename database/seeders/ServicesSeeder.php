<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Services;

class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $servicesList = [
            [
                'name' => 'Prescription Glasses',
                'description' => 'Custom-made glasses to match your vision prescription perfectly.',
                'route_name' => "User.services.PrescriptionGlasses.index",
            ],

            [
                'name' => 'Lens Replacement',
                'description' => 'Quick and precise lens replacement for your existing frames.',
                'route_name' =>"User.services.LensReplacement.index",
            ],
            [
                'name' => 'Appointment',
                'description' => 'Professional eye exams to ensure your vision stays healthy.',
                'route_name' =>"User.services.appointment.index",
            ],

        ];
        foreach ($servicesList as $service) {
            Services::create($service);
        }

    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Doctor;
use App\Models\DoctorDetail;
use App\Models\User;
use App\Models\DoctorLicense;
use App\Models\DoctorSchedule;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        $faker = Faker::create();
        $daysOfWeek = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];

        // Create 10 fake doctors
        for ($i = 1; $i <= 10; $i++) {

            $doctor = Doctor::create([
                'doctor_code' => 'DOC' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password'),
                'contact_number' => $faker->unique()->phoneNumber,
                'status' => 'Active',
            ]);

            // Profile
            $doctor->profile()->create([
                'designation' => $faker->jobTitle,
                'qualification' => $faker->randomElement(['MBBS', 'MD', 'MS', 'BS Optometry']),
                'experience_years' => $faker->numberBetween(3, 25),
                'specialization' => $faker->randomElement(['Cataract', 'LASIK', 'Glaucoma', 'Pediatric Eye Care', 'Retina']),
                'consultation_fee' => $faker->numberBetween(500, 3000),
                'photo_url' => $faker->imageUrl(200, 200, 'people'),
            ]);

            // License
            $doctor->license()->create([
                'license_number' => 'LIC' . $faker->unique()->numerify('######'),
                'expiry_date' => $faker->dateTimeBetween('now', '+5 years')->format('Y-m-d'),
            ]);

            // Schedule
            $doctor->schedules()->create([
                'working_days' => $faker->randomElements($daysOfWeek, $faker->numberBetween(3,6)),
                'start_time' => $faker->time('H:i', '08:00'),
                'end_time' => $faker->time('H:i', '18:00'),
                'status' => 'Active',
            ]);
        }
    }
}

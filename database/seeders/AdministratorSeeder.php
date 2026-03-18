<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Administrator;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;


class AdministratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Administrator::create([
            'name' => 'Ananta Poudyal',
            'email' => 'admin1@example.com',
            'password' => Hash::make('password'),
            'is_active' => true,
        ]);

        $detail = $admin->details()->create([
            'designation' => 'System Administrator',
            'profile_photo' => 'ananta.jpg',
        ]);

        $detail->contacts()->create([
            'phone' => '9841234567',
            'address' => 'Kathmandu',
            'city' => 'Kathmandu',
            'country' => 'Nepal',
        ]);

        $adminRole = Role::where('name', 'admin')->first();
        $admin->roles()->attach($adminRole->id);
    }
}

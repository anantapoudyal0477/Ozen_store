<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
  public function run(): void
    {
        $roles = [
            ['name' => 'super_admin', 'description' => 'Full system access'],
            ['name' => 'admin', 'description' => 'Manage content & users'],
            ['name' => 'editor', 'description' => 'Edit content only'],
            ['name' => 'support', 'description' => 'View & respond to tickets'],
        ];

        foreach ($roles as $role) {
            Role::updateOrCreate(['name' => $role['name']], $role);
        }
    }
}

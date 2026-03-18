<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UserDetail;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Nested JSON-like array for users and their details
        $users = [
            [
                'name' => 'Test User 1',
                'email' => 'anantapoudyal@gmail.com',
                'user_type' => 'user',
                'password' => 'sknJ@bZzG3EJrAW',
                'details' => [
                    'full_name' => 'Ananta Poudyal',
                    'phone' => '9800000001',
                    'address' => 'Kathmandu, Nepal',
                    'city' => 'Kathmandu',
                ]
            ],
            [
                'name' => 'Test User 2',
                'email' => 'user2@example.com',
                'user_type' => 'user',
                'password' => 'password',
                'details' => [
                    'full_name' => 'User Two',
                    'phone' => '9800000002',
                    'address' => 'Lalitpur, Nepal',
                    'city' => 'Lalitpur',
                ]
            ],
            [
                'name' => 'Test User 3',
                'email' => 'user3@example.com',
                'user_type' => 'user',
                'password' => 'password',
                'details' => [
                    'full_name' => 'User Three',
                    'phone' => '9800000003',
                    'address' => 'Bhaktapur, Nepal',
                    'city' => 'Bhaktapur',
                ]
            ],
        ];

        foreach ($users as $userData) {
            // Create user
            $user = User::firstOrCreate(
                ['email' => $userData['email']],
                [
                    'name' => $userData['name'],
                    'user_type' => $userData['user_type'],
                    'password' => bcrypt($userData['password']),
                ]
            );

            // Create user details
            if (!empty($userData['details'])) {
                UserDetail::firstOrCreate(
                    ['user_id' => $user->id],
                    [
                        'full_name' => $userData['details']['full_name'] ?? null,
                        'email' => $userData['email'], // keep same as user email
                        'phone' => $userData['details']['phone'] ?? null,
                        'address' => $userData['details']['address'] ?? null,
                        'city' => $userData['details']['city'] ?? null,
                    ]
                );
            }
        }
    }
}

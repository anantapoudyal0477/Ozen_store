<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserNavigationLinksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $userNavigationLinksData = [
            [
                'name' => 'Home',
                'route_name' => 'User.Homepage.index',
                'url' => null,
                'icon' => 'fa-solid fa-house',
                'order' => 1,
                'is_active' => true,
                'target' => '_self',
            ],
            [
                'name' => 'Services',
                'route_name' => 'User.services.index',
                'url' => null,
                'icon' => 'fa-solid fa-briefcase',
                'order' => 2,
                'is_active' => true,
                'target' => '_self',
            ],
            [
                'name' => 'Products',
                'route_name' => 'User.products.index',
                'url' => null,
                'icon' => 'fa-solid fa-box',
                'order' => 3,
                'is_active' => true,
                'target' => '_self',
            ],

            [
                'name' => 'Cart',
                'route_name' => 'User.cart.index',
                'url' => null,
                'icon' => 'fa-solid fa-cart-shopping',
                'order' => 5,
                'is_active' => true,
                'target' => '_self',
            ],
            [
                'name' => 'Wishlist',
                'route_name' => 'User.wishlist.index',
                'url' => null,
                'icon' => 'fa-solid fa-heart',
                'order' => 6,
                'is_active' => true,
                'target' => '_self',
            ],
            [
                'name' => 'Orders',
                'route_name' => 'User.orders.index',
                'url' => null,
                'icon' => 'fa-solid fa-list-check',
                'order' => 7,
                'is_active' => true,
                'target' => '_self',
            ],
            [
                'name' => 'Appointments',
                'route_name' => 'User.services.appointment.index',
                'url' => null,
                'icon' => 'fa-solid fa-calendar-check',
                'order' => 8,
                'is_active' => true,
                'target' => '_self',
            ],
        ];



        foreach ($userNavigationLinksData as $data) {
            \App\Models\UserNavigationLinks::create($data);
        }
    }
}

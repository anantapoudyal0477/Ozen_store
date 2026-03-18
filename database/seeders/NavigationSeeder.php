<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Navigation;

class NavigationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
$navigations = [
            [
                "name" => "Home",
                "route_name" => "Index",
                "url" => null,
                "order" => 1,
                "icon" => "fa-solid fa-house",
                "is_active" => true,
                "target" => "_self",
            ],
            [
                "name" => "About",
                "route_name" => "About",
                "url" => null,
                "order" => 2,
                "icon" => "fa-solid fa-circle-info",
                "is_active" => true,
                "target" => "_self",
            ],
            [
                "name" => "Products",
                "route_name" => "Products.index",
                "url" => null,
                "order" => 3,
                "icon" => "fa-solid fa-box-open",
                "is_active" => true,
                "target" => "_self",
            ],
            [
                "name" => "Services",
                "route_name" => "Services.index",
                "url" => null,
                "order" => 4,
                "icon" => "fa-solid fa-handshake",
                "is_active" => true,
                "target" => "_self",
            ],
            [
                "name" => "Contact",
                "route_name" => "Contact.index",
                "url" => null,
                "order" => 5,
                "icon" => "fa-solid fa-phone",
                "is_active" => true,
                "target" => "_self",
            ],
            [
                "name" => "Register",
                "route_name" => "Register.index",
                "url" => null,
                "order" => 6,
                "icon" => "fa-solid fa-user-plus",
                "is_active" => true,
                "target" => "_self",
            ],
            [
                "name" => "Login",
                "route_name" => "Login.index",
                "url" => null,
                "order" => 7,
                "icon" => "fa-solid fa-right-to-bracket",
                "is_active" => true,
                "target" => "_self",
            ],

        ];

        foreach ($navigations as $nav) {
            Navigation::create($nav); // triggers encryption & timestamps
        }

    }
}

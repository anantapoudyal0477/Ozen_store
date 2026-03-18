<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AdminNavigationLinks;

class AdminNavigationLinksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
$links = [
    // Top-Level Items
    ["name" => "Dashboard", "route_name" => "Administrator.Dashboard.index", "group" => null, "top" => true],
    ["name" => "Administrators", "route_name" => "Administrator.Homepage.index", "group" => null, "top" => true],

    // Product Management
    ["name" => "Categories", "route_name" => "Administrator.Categories.index", "group" => "Product Management", "top" => false],
    ["name" => "Company Brand", "route_name" => "Administrator.Brand.index", "group" => "Product Management", "top" => false],
    ["name" => "Products", "route_name" => "Administrator.Products.index", "group" => "Product Management", "top" => false],
    ["name" => "Product Types", "route_name" => "Administrator.Product_Types.index", "group" => "Product Management", "top" => false],
    ["name" => "Accessories", "route_name" => "Administrator.Accessories.index", "group" => "Product Management", "top" => false],

    // Glasses
    ["name" => "Colors", "route_name" => "Administrator.Glasses.Colors.index", "group" => "Glasses", "top" => false],
    ["name" => "Brand", "route_name" => "Administrator.Glasses.Brands.index", "group" => "Glasses", "top" => false],
    ["name" => "Styles", "route_name" => "Administrator.Glasses.Styles.index", "group" => "Glasses", "top" => false],
    ["name" => "Usages", "route_name" => "Administrator.Glasses.Usages.index", "group" => "Glasses", "top" => false],

    // Services / Settings
    ["name" => "Services", "route_name" => "Administrator.Services.index", "group" => "Services / Settings", "top" => false],
    ["name" => "Settings", "route_name" => "Administrator.Settings.index", "group" => "Services / Settings", "top" => false],

    // Info
    ["name" => "Contacts", "route_name" => "Administrator.Contacts.index", "group" => "Info", "top" => false],
    ["name" => "About", "route_name" => "Administrator.About.index", "group" => "Info", "top" => false],
    ["name" => "Socials", "route_name" => "Administrator.Socials.index", "group" => "Info", "top" => false],
    ["name" => "Copyrights", "route_name" => "Administrator.Copyrights.index", "group" => "Info", "top" => false],

    // Orders
    ["name" => "Orders", "route_name" => "Administrator.Orders.index", "group" => null, "top" => true],
// sales report
    ["name" => "Sales", "route_name" => "Administrator.Sales.index", "group" => null, "top" => true],

    //appointments
    ["name" => "Appointments", "route_name" => "Administrator.Appointment.index", "group" => null, "top" => true],

    //list of users
    ["name" => "Users management", "route_name" => "Administrator.UsersManagement.index", "group" => null, "top" => true],

    //list of Staff
    ["name" => "Staff", "route_name" => "Administrator.Staff.index", "group" => null, "top" => true],

    //list of suppliers
    ["name" => "Suppliers", "route_name" => "Administrator.Suppliers.index", "group" => null, "top" => true],

    //list of doctors
    ["name" => "Doctors", "route_name" => "Administrator.Doctors.index", "group" => null, "top" => true],
];

        foreach ($links as $link) {
            AdminNavigationLinks::create($link);
        }
    }
}

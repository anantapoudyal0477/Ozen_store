<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\ViewerHome_cta;
use App\Models\ViewerHomeHero;
use App\Models\ViewerHomeHeroStats;
use Faker\Provider\ar_EG\Company;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use function PHPSTORM_META\map;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();


        $this->call([
            UserSeeder::class,
            //viewer seeders
            CompanyBrandSeeder::class,
            AboutSeeder::class,
            ContactsSeeder::class,
            ProductsSeeder::class,
            ServicesSeeder::class,

            SocialsSeeder::class,
            CopyrightSeeder::class,


            NavigationSeeder::class,
            SettingSeeder::class,
            ProductTypesSeeder::class,
            GlassesStylesSeeder::class,
            GlassesUsagesSeeder::class,
            GlassesColorSeeder::class,

            BrandSeeder::class,

            AdminNavigationLinksSeeder::class,
            AccessoriesSeeder::class,
            ViewerHomeHeroSeeder::class,
            ViewerHomeFeaturesSeeder::class,
            ViewerHomeCtaSeeder::class,
            ViewerHomeHeroStatsSeeder::class,
            CategoriesSeeder::class,
            // PrescriptionGlassesSeeder::class,
            UserNavigationLinksSeeder::class,
            EyeLensTypeSeeder::class,
           
            // EyeLensSeeder::class,
            MaterialsSeeder::class,
            DoctorSeeder::class,

RoleSeeder::class,

            AdministratorSeeder::class,
                    WearingReplacementsSeeder::class,




        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Socials;

class SocialsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $socialData=[
            ["social_platform_name"=>"Facebook","social_platform_icon"=>"fab fa-facebook","social_platform_link"=>"https://www.facebook.com/"],
            ["social_platform_name"=>"twitter","social_platform_icon"=>"fab fa-twitter","social_platform_link"=>"https://www.twitter.com/"],
            ["social_platform_name"=>"instagram","social_platform_icon"=>"fab fa-instagram","social_platform_link"=>"https://www.instagram.com/"],
            ["social_platform_name"=>"linkedin","social_platform_icon"=>"fab fa-linkedin","social_platform_link"=>"https://www.linkedin.com/"],
            ["social_platform_name"=>"youtube","social_platform_icon"=>"fab fa-youtube","social_platform_link"=>"https://www.youtube.com/"]
        ];
        foreach($socialData as $data){
            Socials::create($data);

        }
    }
}

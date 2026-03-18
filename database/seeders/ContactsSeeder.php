<?php

namespace Database\Seeders;

use App\Models\Contacts;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $contactData=[
            ["Email"=>"EyeGlasses@gmail.com","Phone"=>"01-668899","Address"=>"Kathmandu"],

        ];
        foreach($contactData as $data){
            Contacts::create($data);
        }
    }
}

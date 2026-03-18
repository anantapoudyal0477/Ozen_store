<?php

    namespace Database\Seeders;

    use Illuminate\Database\Console\Seeds\WithoutModelEvents;
    use Illuminate\Database\Seeder;
    use App\Models\Materials;

    class MaterialsSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         */
        public function run(): void
        {
             // Assuming ProductTypes IDs: 1 = Glasses, 2 = Accessories, 3 = Eye Lenses
        $materials = [
            // Eye Lens materials
            ['name'=>'Hydrogel','product_type_id'=>3],
            ['name'=>'Silicone Hydrogel','product_type_id'=>3],
            ['name'=>'PMMA','product_type_id'=>3],
            ['name'=>'Rigid Gas Permeable','product_type_id'=>3],
            ['name'=>'Scleral Lens Material','product_type_id'=>3],
            ['name'=>'Hybrid Lens Material','product_type_id'=>3],
            ['name'=>'Polycarbonate','product_type_id'=>3],
            ['name'=>'Trivex','product_type_id'=>3],
            ['name'=>'Polymer Blend','product_type_id'=>3],
            ['name'=>'Soft Silicone','product_type_id'=>3],

            // Eyeglass frame materials
            ['name'=>'Plastic','product_type_id'=>1],
            ['name'=>'Metal','product_type_id'=>1],
            ['name'=>'Acetate','product_type_id'=>1],
            ['name'=>'Titanium','product_type_id'=>1],
            ['name'=>'Wood','product_type_id'=>1],
            ['name'=>'Carbon Fiber','product_type_id'=>1],
            ['name'=>'Nylon','product_type_id'=>1],
            ['name'=>'Aluminum','product_type_id'=>1],
            ['name'=>'Stainless Steel','product_type_id'=>1],
            ['name'=>'Combination (e.g., Metal & Acetate)','product_type_id'=>1],
        ];

        foreach ($materials as $material) {
            Materials::create($material);
        }

        }
    }

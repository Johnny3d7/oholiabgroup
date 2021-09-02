<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Product::truncate();

        $faker = (new \Faker\Factory())::create();

        Product::create([
            'ref' => 'P' . 1,
            'lib' => "Eau minérale Harod - Pack de 6 x 1L",
            'price' => 5000,
            'id_product_category' => 2,
            'id_type_product' => 2  
        ]);

        Product::create([
            'ref' => 'P' . 2,
            'lib' => "Eau minérale Harod - Pack de 9 x 570ml",
            'price' => 3600,
            'id_product_category' => 2,
            'id_type_product' => 2  
        ]);

        Product::create([
            'ref' => 'P' . 3,
            'lib' => "Eau minérale Harod - Carton gobelets de 24 x 330ml",
            'price' => 3000,
            'id_product_category' => 2,
            'id_type_product' => 2  
        ]);

        Product::create([
            'ref' => 'P' . 4,
            'lib' => "Poulet bio THALILA (3Kg)",
            'price' => 5000,
            'id_product_category' => 1,
            'id_type_product' => 1  
        ]);

        Product::create([
            'ref' => 'P' . 5,
            'lib' => "Poulet de chair THALILA (1,5 - 2Kg)",
            'price' => 3000,
            'id_product_category' => 1,
            'id_type_product' => 1  
        ]);

        Product::create([
            'ref' => 'P' . 6,
            'lib' => "Poisson Tilapia 1Kg",
            'price' => 3000,
            'id_product_category' => 1,
            'id_type_product' => 1  
        ]);

        Product::create([
            'ref' => 'P' . 7,
            'lib' => "Poisson Silure 1Kg",
            'price' => 3000,
            'id_product_category' => 1,
            'id_type_product' => 1  
        ]);

        

        /*for ($i = 0; $i < 15; $i++) {
            $j = $i+1;
            $client = Product::create([
                'ref' => 'P' . $j,
                'lib' => $faker->lastName(),
                'description' => $faker->text($maxNbChars = 100),
                'stockalert' => rand(100,500),
                'unite_poids' => $faker->randomElement($array = ['Tonne', 'Kilogramme','Gramme']),
                'poids' => rand(1, 200),
                'price' => rand(140, 240000),
                'id_product_category' => rand(1, 4),
                'id_type_product' => rand(1, 2)
            ]);
        }*/
    }
}

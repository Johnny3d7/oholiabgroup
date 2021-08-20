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

        for ($i = 0; $i < 15; $i++) {
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
        }
    }
}

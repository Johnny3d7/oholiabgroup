<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductCategory;

class ProductCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        ProductCategory::truncate();

        $type= [
            'Produit AKÉBIÉ',
            'Produit OBP INC',
            'Produit fabrication'
        ];

        for ($i = 0; $i < 3; $i++) {
            ProductCategory::create([
                'lib' => $type[$i],
            ]);
        }
    }
}

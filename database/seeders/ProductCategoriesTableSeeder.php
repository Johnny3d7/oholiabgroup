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
            'Matériel de bureau',
            'Médicament'
        ];

        for ($i = 0; $i < 4; $i++) {
            ProductCategory::create([
                'lib' => $type[$i],
            ]);
        }
    }
}

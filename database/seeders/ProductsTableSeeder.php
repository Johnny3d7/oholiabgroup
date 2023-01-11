<?php

namespace Database\Seeders;

use App\Models\EntrepotsHasProduct;
use App\Models\LigneMouvement;
use App\Models\Mouvement;
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
        if(config('database.default') == 'mysql') \DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        Mouvement::truncate();
        LigneMouvement::truncate();
        Product::truncate();
        EntrepotsHasProduct::truncate();
        if(config('database.default') == 'mysql') \DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    

        Product::create([
            'name' => "Eau minérale Harod - Pack de 6 x 1L",
            'type' => 5, // 'Fragile',
            'nature' => 7, // 'Pack',
            'unite' => 1, // 'unité',
            'image' => 'storage/Products/Optimized-bo.png',
            'id_categories' => 2,
            'id_entreprises' => 3,
        ]);

        Product::create([
            'name' => "Eau minérale Harod - Pack de 9 x 570ml",
            'type' => 5, // 'Fragile',
            'nature' => 7, // 'Pack',
            'unite' => 1, // 'unité',
            'image' => 'storage/Products/Optimized-bo.png',
            'id_categories' => 2,
            'id_entreprises' => 3,
        ]);

        Product::create([
            'name' => "Eau minérale Harod - Carton 24 x 330ml",
            'type' => 4, // 'Périssable',
            'nature' => 7, // 'Pack',
            'unite' => 1, // 'unité',
            'image' => 'storage/Products/Optimized-gobelet-250-ml.jpg',
            'id_categories' => 2,
            'id_entreprises' => 3,
        ]);
        
        Product::create([
            'name' => "Poulet bio THALILA (3Kg)",
            'type' => 4, // 'Périssable',
            'nature' => 6, // 'Unité',
            'unite' => 1, // 'unité',
            'image' => 'storage/Products/Thalila_Boutique-300x300.png',
            'id_categories' => 1,
            'id_entreprises' => 2,
        ]);

        Product::create([
            'name' => "Poulet de chair (1,5 - 2Kg)",
            'type' => 4, // 'Périssable',
            'nature' => 6, // 'Unité',
            'unite' => 1, // 'unité',
            'image' => 'storage/Products/Poulet-de-chair_Boutique-300x300.png',
            'id_categories' => 1,
            'id_entreprises' => 2,
        ]);

        Product::create([
            'name' => "Poisson Tilapia 1Kg",
            'type' => 4, // 'Périssable',
            'nature' => 6, // 'Unité',
            'unite' => 1, // 'unité',
            'image' => 'storage/Products/Tilapia_Boutique-300x300.png',
            'id_categories' => 1,
            'id_entreprises' => 2,
        ]);

        Product::create([
            'name' => "Poisson Silure 1Kg",
            'type' => 4, // 'Périssable',
            'nature' => 6, // 'Unité',
            'unite' => 1, // 'unité',
            'image' => 'storage/Products/Silure_Boutique-300x300.png',
            'id_categories' => 1,
            'id_entreprises' => 2,
        ]);

        Product::create([
            'name' => "Alevins de Silure",
            'type' => 4, // 'Périssable',
            'nature' => 6, // 'Unité',
            'unite' => 1, // 'unité',
            'image' => 'storage/Products/alevins_silure-300x300.jpg',
            'id_categories' => 1,
            'id_entreprises' => 2,
        ]);

        Product::create([
            'name' => "Alevins de Tilapia",
            'type' => 4, // 'Périssable',
            'nature' => 6, // 'Unité',
            'unite' => 1, // 'unité',
            'image' => 'storage/Products/alevins_tilapia-300x300.jpg',
            'id_categories' => 1,
            'id_entreprises' => 2,
        ]);

        Product::create([
            'name' => "Gants médicaux (propres)",
            'type' => 4, // 'Périssable',
            'nature' => 6, // 'Unité',
            'unite' => 1, // 'unité',
            'image' => 'storage/Products/gants-medicaux-300x300-top.jpg',
            'id_categories' => 3,
            'id_entreprises' => 3,
        ]);
        
        /*for ($i = 0; $i < 15; $i++) {
            $j = $i+1;
            $client = Product::create([
                'name' => $faker->lastName(),
                'description' => $faker->text($maxNbChars = 100),
                'stockalert' => rand(100,500),
                'unite_poids' => $faker->randomElement($array = ['Tonne', 'Kilogramme','Gramme']),
                'poids' => rand(1, 200),
                'type' => ''(140, 240000),
                'nature' => rand(1,'solide',
                'unite' => runité(1,'solide',
                'id_categories' => rand(1, 4),
            ]);
        }*/
    }
}

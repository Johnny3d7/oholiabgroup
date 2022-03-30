<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use App\Models\ProductCategory;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Category::truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $type= [
            'Produit',
            'Matière Première',
            'Matériel',
            'Aliment'
        ];

        for ($i = 0; $i < 3; $i++) {
            Category::create([
                'name' => $type[$i],
            ]);
        }
    }
}

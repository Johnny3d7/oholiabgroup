<?php

namespace Database\Seeders;

use App\Models\TypeProduct;
use Illuminate\Database\Seeder;

class TypeProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        TypeProduct::truncate();

        $type= [
            'Produit périssable',
            'Produit durable',
            'Matière première',
            'Produit fragile'
        ];

        for ($i = 0; $i < 4; $i++) {
            TypeProduct::create([
                'lib' => $type[$i],
            ]);
        }
    }
}

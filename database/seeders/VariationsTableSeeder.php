<?php

namespace Database\Seeders;

use App\Models\Variation;
use Illuminate\Database\Seeder;

class VariationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Variation::truncate();

        $faker = (new \Faker\Factory())::create();

            for ($i = 0; $i < 400; $i++) {
               
                $variation = Variation::create([
                    
                    'observation' => $faker->text($maxNbChars = 100),
                    'typemouv' => $faker->randomElement($array = ['1', '0']),
                    'production' => rand(0, 1),
                    'datemouv' => $faker->dateTime(),
                    'id_entreprise' => rand(1, 3),
                    'id_product' => rand(1, 15)
                ]);

                if ($variation->typemouv==1) {
                    $variation->qte_entree = rand(80, 110);
                    $variation->qte_sortie = 0;
                } else {
                    $variation->qte_sortie = rand(1, 28);
                    $variation->qte_entree = 0;
                }

                $variation->save();
                
            }

    }
}

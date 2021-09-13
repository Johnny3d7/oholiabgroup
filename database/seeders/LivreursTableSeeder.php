<?php

namespace Database\Seeders;

use App\Models\Livreur;
use Illuminate\Database\Seeder;

class LivreursTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Livreur::truncate();

        $faker = (new \Faker\Factory())::create();



        for ($i = 0; $i < 5; $i++) {
            Entreprise::create([
                'nom' => $faker->firstName().' '.$faker->lastName(),
                'email' => $faker->email,
                'adresse' => $faker->address(),
                'ncc' => 'XXXX-XXXX',
                'contact' =>rand(10, 99). '' . rand(10, 99) . '' . rand(10, 99) . '' . rand(10, 99) . '' . rand(10, 99),
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Entreprise;
use Illuminate\Database\Seeder;

class EntreprisesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Entreprise::truncate();

        $faker = (new \Faker\Factory())::create();

        $entreprise= [
            'Oholiab Group',
            'Akébié SARL',
            'OBP INC.'
        ];

        for ($i = 0; $i < 3; $i++) {
            Entreprise::create([
                'nom' => $entreprise[$i],
                'email' => $faker->email,
                'adresse' => $faker->address(),
                'contact' =>rand(10, 99). '' . rand(10, 99) . '' . rand(10, 99) . '' . rand(10, 99) . '' . rand(10, 99),
            ]);
        }
    }
}

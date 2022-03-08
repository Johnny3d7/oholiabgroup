<?php

namespace Database\Seeders;

use App\Models\Entrepot;
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

        $entreprises= [
            'Oholiab Group',
            'Akébié SARL',
            'OBP INC.'
        ];

        for ($i = 0; $i < 3; $i++) {
            $entreprise = Entreprise::create([
                'nom' => $entreprises[$i],
                'email' => $faker->email,
                'adresse' => $faker->address(),
                'ncc' => 'XXXX-XXXX',
                'contact' =>rand(10, 99). '' . rand(10, 99) . '' . rand(10, 99) . '' . rand(10, 99) . '' . rand(10, 99),
            ]);

            $suffix= "ENT";

            $entrepot = Entrepot::create([
                'ref'=> $suffix.$entreprise->id,
                'lib' => "Principal ".$entreprises[$i],
                'contact' => $faker->phoneNumber(),
                'id_entreprise' => $entreprise->id,
                'id_recorder' => 1
            ]);
        }
    }
}

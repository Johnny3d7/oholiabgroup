<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Client;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Client::truncate();

        $faker = (new \Faker\Factory())::create();

        for ($i = 0; $i < 30; $i++) {
            $j = $i+1;
            $client = Client::create([
                'codeclient' => 'CL' . $j,
                'nom' => $faker->firstName,
                'email' => $faker->email,
                'adresse' => $faker->address(),
                'category' => $faker->randomElement($array = ['Personne morale', 'Personne physique']),
                'contact' =>rand(10, 99). '' . rand(10, 99) . '' . rand(10, 99) . '' . rand(10, 99) . '' . rand(10, 99),
                'statut' => $faker->randomElement($array = ['SA', 'SARL','Masculin','Féminin']),
                'id_type_client' => rand(1, 3)
            ]);
        }
    }
}

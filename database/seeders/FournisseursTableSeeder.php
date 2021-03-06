<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Fournisseur;

class FournisseursTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Fournisseur::truncate();


        $faker = (new \Faker\Factory())::create();

        Fournisseur::create([
            'codefour' => 'F' . 1,
            'nom' => 'OHOLIAB',
            'email' => $faker->email,
            'contact' => rand(10, 99). '' . rand(10, 99) . '' . rand(10, 99) . '' . rand(10, 99) . '' . rand(10, 99),
            'ncc' => 'XXXX-XXXX',
            'id_type_fournisseur' => 2
        ]);

        Fournisseur::create([
            'codefour' => 'F' . 2,
            'nom' => 'AKÉBIÉ',
            'email' => $faker->email,
            'contact' => rand(10, 99). '' . rand(10, 99) . '' . rand(10, 99) . '' . rand(10, 99) . '' . rand(10, 99),
            'ncc' => 'XXXX-XXXX',
            'id_type_fournisseur' => 2
        ]);
    
        Fournisseur::create([
            'codefour' => 'F' . 3,
            'nom' => 'OBP INC',
            'email' => $faker->email,
            'contact' => rand(10, 99). '' . rand(10, 99) . '' . rand(10, 99) . '' . rand(10, 99) . '' . rand(10, 99),
            'ncc' => 'XXXX-XXXX',
            'id_type_fournisseur' => 2
        ]);

        $j = 2;

        for ($i = 2; $i < 10; $i++) {
            $nom = $faker->firstName;
            $contact =rand(10, 99). '' . rand(10, 99) . '' . rand(10, 99) . '' . rand(10, 99) . '' . rand(10, 99);
            $j = $i+1;
            $four = Fournisseur::create([
                'codefour' => 'F' . $j,
                'nom' => $nom,
                'email' => $faker->email,
                'contact' => $contact,
                'ncc' => 'XXXX-XXXX',
                'id_type_fournisseur' => 1
            ]);
    }

    
}
}
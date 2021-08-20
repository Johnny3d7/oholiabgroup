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

        for ($i = 0; $i < 10; $i++) {
            $nom = $faker->firstName;
            $contact =rand(10, 99). '' . rand(10, 99) . '' . rand(10, 99) . '' . rand(10, 99) . '' . rand(10, 99);
            $j = $i+1;
            $four = Fournisseur::create([
                'codefour' => 'F' . $j,
                'nom' => $nom,
                'email' => $faker->email,
                'contact' => $contact,
                'description' => $faker->text($maxNbChars = 100),
                'id_type_fournisseur' => rand(1, 3)
            ]);
    }
}
}
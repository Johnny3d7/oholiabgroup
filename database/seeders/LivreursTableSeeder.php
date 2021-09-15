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

        Livreur::create([
            'nom' => 'Jean martin'
        ]);

        Livreur::create([
            'nom' => 'Pokou charles',
        ]);

        Livreur::create([
            'nom' => 'Victor mathieu',
        ]);

    }
}

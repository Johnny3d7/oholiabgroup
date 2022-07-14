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
        // \DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        Entreprise::truncate();
        Entrepot::truncate();
        // \DB::statement('SET FOREIGN_KEY_CHECKS=1;');



        $faker = (new \Faker\Factory())::create();

        $entreprises= [
            'Oholiab Group' => 'images/logo.png',
            'Akébié SARL' => 'images/logoakebie1.png',
            'OBP INC.' => 'images/faviconobp.png'
        ];

        foreach ($entreprises as $name => $logo) {
            $entreprise = Entreprise::create([
                'name' => $name,
                'ncc' => 'XXXX-XXXX',
                'logo' => $logo,
            ]);

            $entrepot = Entrepot::create([
                'name' => "Principal ".$name,
                'id_entreprises' => $entreprise->id,
            ]);
        }
    }
}

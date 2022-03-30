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
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Entreprise::truncate();
        Entrepot::truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');


        $faker = (new \Faker\Factory())::create();

        $entreprises= [
            'Oholiab Group',
            'Akébié SARL',
            'OBP INC.'
        ];

        for ($i = 0; $i < 3; $i++) {
            $entreprise = Entreprise::create([
                'name' => $entreprises[$i],
                'ncc' => 'XXXX-XXXX',
            ]);

            $entrepot = Entrepot::create([
                'name' => "Principal ".$entreprises[$i],
                'id_entreprises' => $entreprise->id,
            ]);
        }
    }
}

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
        if(config('database.default') == 'mysql') \DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        Entreprise::truncate();
        Entrepot::truncate();
        if(config('database.default') == 'mysql') \DB::statement('SET FOREIGN_KEY_CHECKS=1;');



        $faker = (new \Faker\Factory())::create();

        $entreprises= [
            'Oholiab Group' => [
                'logo' => 'images/logo.png',
                'reference' => 'ENTR0010'
            ],
            'Akébié SARL' => [
                'logo' => 'images/logoakebie1.png',
                'reference' => 'ENTR0020'
            ],
            'OBP INC.' => [
                'logo' => 'images/faviconobp.png',
                'reference' => 'ENTR0030'
            ],
        ];

        foreach ($entreprises as $name => $values) {
            $entreprise = Entreprise::create([
                'name' => $name,
                'ncc' => 'XXXX-XXXX',
                'logo' => $values['logo'],
            ]);
            
            $entrepot = Entrepot::create([
                'reference' => $values['reference'],
                'lieu' => "Siège de $name",
                'name' => "Principal $name",
                'id_entreprises' => $entreprise->id,
            ]);
        }
    }
}

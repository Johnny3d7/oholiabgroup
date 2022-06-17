<?php

namespace Database\Seeders;

use App\Models\Parametre;
use Illuminate\Database\Seeder;

class ParametresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Parametre::truncate();

        $parametres = [
            'unite' => ["Unité", "Kilogramme", "Litre"], 
            'type' => ["Périssable", "Fragile"],
            'nature' => ["Unité", "Pack", "Carton", "Lot"]
        ];

        foreach ($parametres as $param => $values) {
            foreach ($values as $value) {
                Parametre::create([
                    'name' => $value,
                    'type' => $param
                ]);
            }
        }

    }
}

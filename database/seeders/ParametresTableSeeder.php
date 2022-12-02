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
        if(config('database.default') == 'mysql') \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Parametre::truncate();
        if(config('database.default') == 'mysql') \DB::statement('SET FOREIGN_KEY_CHECKS=1;');


        $parametres = [
            'products' => [
                'unite' => ["Unité", "Kilogramme", "Litre"], 
                'type' => ["Périssable", "Fragile"],
                'nature' => ["Unité", "Pack", "Carton", "Lot"]
            ],
            'fournisseurs' => [
                'type' => ["Favoris", "Occasionnel"],
            ]
        ];


        foreach ($parametres as $table => $vals) {
            foreach ($vals as $type => $values) {
                foreach ($values as $value) {
                    Parametre::create([
                        'name' => $value,
                        'type' => $type,
                        'table' => $table,
                    ]);
                }
            }
        }

    }
}

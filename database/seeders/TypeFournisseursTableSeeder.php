<?php

namespace Database\Seeders;

use App\Models\TypeFournisseur;
use Illuminate\Database\Seeder;

class TypeFournisseursTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        TypeFournisseur::truncate();

        $type= [
            'Externe',
            'Interne'
        ];

        for ($i = 0; $i < 2; $i++) {
            TypeFournisseur::create([
                'lib' => $type[$i],
            ]);
        }
    }
}

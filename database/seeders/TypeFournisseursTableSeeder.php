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
            'Type fournisseur 1',
            'Type fournisseur 2',
            'Type fournisseur 3'
        ];

        for ($i = 0; $i < 3; $i++) {
            TypeFournisseur::create([
                'lib' => $type[$i],
            ]);
        }
    }
}

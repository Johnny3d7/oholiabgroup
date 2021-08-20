<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TypeClient;

class TypeClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        TypeClient::truncate();

        $type= [
            'Fidèle',
            'Infidèle'
        ];

        for ($i = 0; $i < 2; $i++) {
            TypeClient::create([
                'lib' => $type[$i],
            ]);
        }
    }
}

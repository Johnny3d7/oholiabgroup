<?php

namespace Database\Seeders;

use App\Models\Motif;
use Illuminate\Database\Seeder;

class MotifsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Motif::truncate();

        $motif= [
            'Fabrication',
            'Mort',
        ];

        for ($i = 0; $i < 2; $i++) {
            Motif::create([
                'lib' => $motif[$i],
            ]);
        }

    }
}

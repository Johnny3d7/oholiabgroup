<?php

namespace Database\Seeders;

use App\Models\ParcAuto\Vehicle;
use Illuminate\Database\Seeder;

class ParcAutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(config('database.default') == 'mysql') \DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        Vehicle::truncate();

        if(config('database.default') == 'mysql') \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        Vehicle::factory()
            ->count(12)
            ->create();

    }
}

<?php

namespace Database\Factories\ParcInfo;

use App\Models\ParcInfo\TypeDevice;
use Illuminate\Database\Eloquent\Factories\Factory;

class DeviceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $nbre = TypeDevice::count();
        return [
            // 'reference' => ,
            'libelle' => $this->faker->words(2, true),
            'date_acquisition' => $this->faker->date(),
            'description' => $this->faker->text(),
            'observations' => $this->faker->text(),
            'id_types' => rand(1, $nbre)
        ];
    }
}

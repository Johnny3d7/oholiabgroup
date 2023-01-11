<?php

namespace Database\Factories\ParcAuto;

use Illuminate\Database\Eloquent\Factories\Factory;

class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // 'reference' => ,
            'libelle' => $this->faker->words(2, true),
            'date_acquisition' => $this->faker->date(),
            'description' => $this->faker->text(),
            'observations' => $this->faker->text(),
            'image' => "storage/Categories/vehicle.png"
        ];
    }
}

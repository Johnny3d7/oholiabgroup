<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TypeDeviceFactory extends Factory
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
            'libelle' => $this->faker->name(),
            'image' => $this->faker->date(),
            'description' => $this->faker->text(),
            'observations' => $this->faker->text(),
        ];
    }
}

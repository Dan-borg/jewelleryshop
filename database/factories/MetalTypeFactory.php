<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MetalTypeFactory extends Factory
{
    public function definition()
    {
        $metals = ['Gold', 'Silver', 'Rose Gold', 'Platinum'];
        $m = $this->faker->randomElement($metals);
        return [
            'name' => $m,
            'purity' => $this->faker->randomElement(['18k','22k','24k', null]),
            'color' => strtolower(str_replace(' ', '-', $m)),
        ];
    }
}

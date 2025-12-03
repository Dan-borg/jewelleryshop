<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\MetalType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class JewelleryItemFactory extends Factory
{
    public function definition()
    {
        $name = $this->faker->words(3, true);
        return [
            'category_id' => Category::factory(),
            'metal_type_id' => MetalType::factory(),
            'name' => ucfirst($name),
            'slug' => Str::slug($name),
            'sku' => strtoupper($this->faker->bothify('SKU-???-####')),
            'description' => $this->faker->paragraph(),
            'price' => $this->faker->randomFloat(2, 20, 2000),
            'weight' => $this->faker->randomFloat(2, 0.5, 50),
            'image_path' => null,
        ];
    }
}

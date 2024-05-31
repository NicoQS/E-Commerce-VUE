<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ImagenProducto>
 */
class ImagenProductoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'imagen' => $this->faker->image('public/storage/productos', 640, 480, 'animals', true),
            'producto_id' => $this->faker->numberBetween(1, 10),
        ];
    }
}

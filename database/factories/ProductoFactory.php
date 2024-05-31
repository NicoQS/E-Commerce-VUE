<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Producto>
 */
class ProductoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->name,
            'descripcion' => $this->faker->text,
            'precio' => $this->faker->randomFloat(2, 0, 1000),
            'stock' => $this->faker->randomNumber(2),
            'categoria_id' => $this->faker->numberBetween(1, 10),
            'proveedor_id' => $this->faker->numberBetween(1, 10),
        ];
    }
}

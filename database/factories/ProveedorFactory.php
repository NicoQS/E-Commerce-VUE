<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Proveedor>
 */
class ProveedorFactory extends Factory
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
            'direccion' => $this->faker->address,
            'telefono' => $this->faker->numerify('#######'),
            'celular' => $this->faker->numerify('##########'),
            'email' => $this->faker->email,
            'cuit' => $this->faker->numberBetween(10000000000, 99999999999),
        ];
    }
}

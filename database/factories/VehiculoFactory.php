<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Cliente;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehiculo>
 */
class VehiculoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
//            'placa' => $this->faker->unique()->regexify('[A-Z0-9]{7}'),
//            'marca' => $this->faker->word,
//            'color' => $this->faker->colorName,
//            'kilometraje' => $this->faker->randomFloat(2, 0, 100000),
//            'cliente_dni_ruc' => Cliente::factory(),
//            'created_at' => now(),
//            'updated_at' => now(),
            //
        ];
    }
}

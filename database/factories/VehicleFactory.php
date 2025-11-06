<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $cars = ['gol', 'ferrari', 'renault', 'porsche', 'bmw', 'audi', 'honda', 'toyota', 'volkswagen'];
        return [
            'user_id' => \App\Models\User::factory(),
            'brand' => fake()->randomElement($cars),
            'model' => fake()->randomElement($cars),
            'year' => fake()->year(),
            'color' => fake()->randomElement(['azul', 'verde', 'amarelo', 'vermelho', 'branco']),
            'plate_number' => fake()->numerify('#########'),
            'status' => fake()->randomElement(['active', 'inactive']),
        ];
    }
}

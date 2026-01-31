<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Prijava>
 */
class PrijavaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user' => $this->faker->numberBetween(1, 10), // ID korisnika 
            'oglas' => $this->faker->numberBetween(1, 10), // ID oglasa 
            'motivaciono_pismo' => $this->faker->paragraph(), 
            'status' => $this->faker->randomElement(['na čekanju', 'odobreno', 'odbijeno']),
             'datum_prijave' => $this->faker->date(),
        ];
    }
}

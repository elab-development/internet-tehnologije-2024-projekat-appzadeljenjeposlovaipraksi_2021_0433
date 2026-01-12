<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kompanija>
 */
class KompanijaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'naziv' => $this->faker->company(),
             'opis' => $this->faker->paragraph(), 
             'broj_zaposlenih' => $this->faker->numberBetween(10, 200),
             'grad' => $this->faker->city(),
             'logo' => $this->faker->imageUrl(640, 480, 'business', true), 
             'email' => $this->faker->unique()->companyEmail(), 
             'telefon' => $this->faker->phoneNumber(),
        ];
    }
}

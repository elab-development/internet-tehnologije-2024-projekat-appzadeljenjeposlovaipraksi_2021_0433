<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Oglas>
 */
class OglasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'naslov' => $this->faker->sentence(3), 
            'opis' => $this->faker->paragraph(), 
            'slika' => $this->faker->imageUrl(640, 480, 'business', true), 
            'lokacija' => $this->faker->city(), '
            tip_posla' => $this->faker->randomElement(['praksa', 'posao', 'honorar']), 
            'plata' => $this->faker->numberBetween(500, 2000), 
            'zahtevi' => $this->faker->sentence(6),
            'kompanija' => Kompanija::factory(),//svaki put pravi novu kompaniju
        ];
    }
}

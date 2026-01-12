<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;   
use Illuminate\Support\Facades\Hash; 


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ime' => $this->faker->name(), 
            'prezime' => $this->faker->lastname(),
            'email' => $this->faker->unique()->safeEmail(), 
            'email_verified_at' => now(), 
            'password' => Hash::make('password'), // default lozinka 
            'role' => $this->faker->randomElement(['student', 'kompanija', 'admin']), 
            'remember_token' => Str::random(10),
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'nisn' => fake()->unique()->numerify('##########'),
            'class_name' => fake()->randomElement(['X IPA 1', 'XI IPS 1', 'XII IPA 2']),
            'phone' => fake()->numerify('08##########'),
            'status' => 'active',
        ];
    }
}

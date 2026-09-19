<?php

namespace Database\Factories;

use App\Models\Payment;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'student_id' => Student::factory(),
            'invoice_number' => 'INV-'.fake()->unique()->numerify('########'),
            'amount' => fake()->randomElement([350000, 750000, 1500000]),
            'description' => 'SPP Semester 1',
            'status' => 'pending',
            'confirmed_at' => null,
            'rejection_reason' => null,
        ];
    }
}

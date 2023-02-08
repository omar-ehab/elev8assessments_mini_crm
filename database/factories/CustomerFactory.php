<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'mobile' => fake()->unique()->numerify('010########'),
            'email' => fake()->unique()->safeEmail(),
            'landline' => fake()->numerify('+203#######'),
            'address' => fake()->address(),
            'added_by' => 1,
        ];
    }
}

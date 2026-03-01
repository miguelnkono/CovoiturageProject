<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
          'booking_id'  => Booking::factory()->completed(),
          'reviewer_id' => User::factory(),
          'reviewee_id' => User::factory(),
          'rating'      => fake()->numberBetween(1, 5),
          'comment'     => fake()->optional(0.7)->paragraph(),
          'type'        => fake()->randomElement(['passenger_to_driver', 'driver_to_passenger']),
        ];
    }
}

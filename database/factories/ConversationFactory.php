<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\Ride;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Conversation>
 */
class ConversationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
          'ride_id'    => Ride::factory(),
          'booking_id' => fake()->optional()->passthrough(Booking::factory()),
        ];
    }
}

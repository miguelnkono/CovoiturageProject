<?php

namespace Database\Factories;

use App\Models\Location;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RideSearch>
 */
class RideSearchFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
          'user_id'         => User::factory(),
          'origin_id'       => Location::factory(),
          'destination_id'  => Location::factory(),
          'desired_date'    => fake()->optional()->dateTimeBetween('now', '+30 days')?->format('Y-m-d'),
          'seats_needed'    => fake()->numberBetween(1, 3),
          'max_price'       => fake()->optional()->randomElement([1000, 2000, 3000, 5000]),
          'is_alert_active' => fake()->boolean(30),
        ];
    }
}

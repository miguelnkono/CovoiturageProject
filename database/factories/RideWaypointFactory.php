<?php

namespace Database\Factories;

use App\Models\Location;
use App\Models\Ride;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RideWaypoint>
 */
class RideWaypointFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array
  {
    return [
      'ride_id'        => Ride::factory(),
      'location_id'    => Location::factory(),
      'order'          => fake()->numberBetween(1, 5),
      'arrival_time'   => fake()->optional()->dateTimeBetween('now', '+8 hours'),
      'departure_time' => fake()->optional()->dateTimeBetween('now', '+8 hours'),
    ];
  }
}

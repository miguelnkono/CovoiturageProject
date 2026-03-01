<?php

namespace Database\Factories;

use App\Models\Location;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ride>
 */
class RideFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   * @throws \DateMalformedStringException
   */
  public function definition(): array
  {
    $departure = fake()->dateTimeBetween('now', '+30 days');
    $seats     = fake()->numberBetween(1, 4);

    return [
      'driver_id'          => User::factory()->driver(),
      'vehicle_id'         => Vehicle::factory(),
      'origin_id'          => Location::factory(),
      'destination_id'     => Location::factory(),
      'departure_datetime' => $departure,
      'arrival_datetime'   => (clone $departure)->modify('+' . fake()->numberBetween(1, 8) . ' hours'),
      'distance_km'        => fake()->randomFloat(1, 10, 600),
      'duration_min'       => fake()->numberBetween(30, 480),
      'seats_available'    => $seats,
      'seats_total'        => $seats,
      'price_per_seat'     => fake()->randomElement([500, 1000, 1500, 2000, 2500, 3000, 5000]),
      'status'             => 'published',
      'description'        => fake()->optional()->sentence(),
      'is_recurrent'       => false,
      'co2_saved_kg'       => fake()->randomFloat(2, 0.5, 50),
    ];
  }
  public function published(): static
  {
    return $this->state(['status' => 'published']);
  }

  public function completed(): static
  {
    return $this->state([
      'status'             => 'completed',
      'departure_datetime' => fake()->dateTimeBetween('-30 days', '-1 day'),
    ]);
  }

  public function cancelled(): static
  {
    return $this->state(['status' => 'cancelled']);
  }
}

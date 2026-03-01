<?php

namespace Database\Factories;

use App\Models\Location;
use App\Models\Ride;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array
  {
    return [
      'ride_id'             => Ride::factory(),
      'passenger_id'        => User::factory()->passenger(),
      'seats_booked'        => fake()->numberBetween(1, 2),
      'pickup_location_id'  => Location::factory(),
      'dropoff_location_id' => Location::factory(),
      'status'              => 'confirmed',
      'total_price'         => fake()->randomElement([1000, 2000, 3000, 5000, 10000]),
      'cancelled_at'        => null,
      'cancel_reason'       => null,
    ];
  }

  public function pending(): static
  {
    return $this->state(['status' => 'pending']);
  }

  public function confirmed(): static
  {
    return $this->state(['status' => 'confirmed']);
  }

  public function cancelled(): static
  {
    return $this->state([
      'status'       => 'cancelled',
      'cancelled_at' => now(),
      'cancel_reason'=> fake()->sentence(),
    ]);
  }

  public function completed(): static
  {
    return $this->state(['status' => 'completed']);
  }
}

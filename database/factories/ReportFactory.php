<?php

namespace Database\Factories;

use App\Models\Ride;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Report>
 */
class ReportFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array
  {
    return [
      'reporter_id'      => User::factory(),
      'reported_user_id' => User::factory(),
      'ride_id'          => fake()->optional()->passthrough(Ride::factory()),
      'reason'           => fake()->randomElement(['harassment', 'fraud', 'no_show', 'dangerous_driving', 'other']),
      'description'      => fake()->paragraph(),
      'status'           => fake()->randomElement(['pending', 'reviewed', 'resolved']),
    ];
  }

  public function pending(): static
  {
    return $this->state(['status' => 'pending']);

  }
}

<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DriverProfile>
 */
class DriverProfileFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array
  {
    return [
      'user_id'             => User::factory()->driver(),
      'license_number'      => strtoupper(fake()->bothify('??######')),
      'license_expiry'      => fake()->dateTimeBetween('now', '+5 years')->format('Y-m-d'),
      'is_license_verified' => fake()->boolean(60),
      'years_of_experience' => fake()->numberBetween(1, 30),
      'preferences'         => [
        'music'    => fake()->boolean(),
        'smoking'  => false,
        'animals'  => fake()->boolean(30),
        'talk'     => fake()->randomElement(['love', 'neutral', 'silence']),
      ],
    ];
  }
}

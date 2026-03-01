<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
  public function definition(): array
  {
    return [
      'first_name'   => fake()->firstName(),
      'last_name'    => fake()->lastName(),
      'email'        => fake()->unique()->safeEmail(),
      'phone'        => fake()->phoneNumber(),
      'password'     => Hash::make('password'),
      'avatar_url'   => fake()->imageUrl(200, 200, 'people'),
      'date_of_birth'=> fake()->dateTimeBetween('-60 years', '-18 years')->format('Y-m-d'),
      'gender'       => fake()->randomElement(['male', 'female', 'other']),
      'bio'          => fake()->optional()->sentence(),
      'is_verified'  => fake()->boolean(70),
      'is_active'    => true,
      'role'         => fake()->randomElement(['passenger', 'driver', 'both']),
      'rating_avg'   => fake()->randomFloat(1, 3, 5),
      'rating_count' => fake()->numberBetween(0, 100),
    ];
  }

  public function driver(): static
  {
    return $this->state(['role' => 'driver']);
  }

  public function passenger(): static
  {
    return $this->state(['role' => 'passenger']);
  }

  public function admin(): static
  {
    return $this->state(['role' => 'admin', 'is_verified' => true]);
  }

  public function unverified(): static
  {
    return $this->state(['is_verified' => false]);
  }
}

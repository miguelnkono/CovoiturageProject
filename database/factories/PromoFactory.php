<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Promo>
 */
class PromoFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array
  {
    return [
      'code'               => strtoupper(fake()->unique()->bothify('COVO-????-##')),
      'discount_type'      => fake()->randomElement(['percent', 'fixed']),
      'discount_value'     => fake()->randomElement([5, 10, 15, 20, 500, 1000, 2000]),
      'min_booking_amount' => fake()->optional()->randomElement([2000, 5000]),
      'max_uses'           => fake()->optional()->numberBetween(10, 500),
      'used_count'         => 0,
      'expires_at'         => fake()->optional()->dateTimeBetween('now', '+6 months'),
      'is_active'          => true,
    ];
  }

  public function expired(): static
  {
    return $this->state([
      'expires_at' => fake()->dateTimeBetween('-1 year', '-1 day'),
      'is_active'  => false,
    ]);
  }

  public function percentDiscount(): static
  {
    return $this->state([
      'discount_type'  => 'percent',
      'discount_value' => fake()->numberBetween(5, 30),
    ]);

  }
}

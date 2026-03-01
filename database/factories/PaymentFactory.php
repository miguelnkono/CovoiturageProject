<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array
  {
    return [
      'booking_id'     => Booking::factory(),
      'payer_id'       => User::factory(),
      'amount'         => fake()->randomElement([1000, 2000, 3000, 5000, 10000]),
      'currency'       => 'XAF',
      'method'         => fake()->randomElement(['card', 'mobile_money', 'wallet', 'cash']),
      'status'         => 'paid',
      'transaction_id' => fake()->optional()->uuid(),
      'paid_at'        => now(),
    ];
  }

  public function pending(): static
  {
    return $this->state(['status' => 'pending', 'paid_at' => null, 'transaction_id' => null]);
  }

  public function failed(): static
  {
    return $this->state(['status' => 'failed', 'paid_at' => null]);
  }
}

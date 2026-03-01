<?php

namespace Database\Factories;

use App\Models\Wallet;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WalletTransaction>
 */
class WalletTransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
          'wallet_id'    => Wallet::factory(),
          'type'         => fake()->randomElement(['credit', 'debit', 'refund', 'withdrawal']),
          'amount'       => fake()->randomElement([500, 1000, 2000, 5000]),
          'description'  => fake()->sentence(),
          'reference_id' => fake()->optional()->uuid(),
        ];
    }
}

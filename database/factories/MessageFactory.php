<?php

namespace Database\Factories;

use App\Models\Conversation;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Message>
 */
class MessageFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array
  {
    return [
      'conversation_id' => Conversation::factory(),
      'sender_id'       => User::factory(),
      'content'         => fake()->realText(200),
      'is_read'         => fake()->boolean(40),
    ];
  }
  public function unread(): static
  {
    return $this->state(['is_read' => false]);
  }

  public function read(): static
  {
    return $this->state(['is_read' => true]);
  }
}

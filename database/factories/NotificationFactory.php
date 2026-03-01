<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Notification>
 */
class NotificationFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array
  {
    $type = fake()->randomElement([
      'booking_confirmed', 'ride_cancelled', 'new_message',
      'payment_received', 'review_received', 'ride_starting',
    ]);

    return [
      'user_id' => User::factory(),
      'type'    => $type,
      'title'   => match($type) {
        'booking_confirmed' => 'Réservation confirmée',
        'ride_cancelled'    => 'Trajet annulé',
        'new_message'       => 'Nouveau message',
        'payment_received'  => 'Paiement reçu',
        'review_received'   => 'Nouvel avis',
        'ride_starting'     => 'Votre trajet commence bientôt',
      },
      'body'    => fake()->sentence(),
      'is_read' => fake()->boolean(30),
      'data'    => fake()->optional()->passthrough(['booking_id' => fake()->uuid()]),
    ];
  }

  public function unread(): static
  {
    return $this->state(['is_read' => false]);

  }
}

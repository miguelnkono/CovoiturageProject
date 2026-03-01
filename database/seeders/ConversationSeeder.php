<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Conversation;
use App\Models\ConversationParticipant;
use App\Models\Message;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConversationSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $bookings = Booking::with(['ride.driver', 'passenger'])->get();

    foreach ($bookings as $booking) {
      $conversation = Conversation::create([
        'ride_id'    => $booking->ride_id,
        'booking_id' => $booking->id,
      ]);

      // Ajouter conducteur et passager
      ConversationParticipant::create([
        'conversation_id' => $conversation->id,
        'user_id'         => $booking->ride->driver_id,
      ]);

      ConversationParticipant::create([
        'conversation_id' => $conversation->id,
        'user_id'         => $booking->passenger_id,
      ]);

      // 2-6 messages par conversation
      $participants = [$booking->ride->driver_id, $booking->passenger_id];
      $msgCount     = rand(2, 6);

      for ($i = 0; $i < $msgCount; $i++) {
        Message::factory()->create([
          'conversation_id' => $conversation->id,
          'sender_id'       => $participants[array_rand($participants)],
        ]);
      }
    }
  }
}

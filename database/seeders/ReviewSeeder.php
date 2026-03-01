<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Review;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $completedBookings = Booking::where('status', 'completed')->with('ride.driver')->get();

    foreach ($completedBookings as $booking) {
      // Le passager note le conducteur
      Review::factory()->create([
        'booking_id'  => $booking->id,
        'reviewer_id' => $booking->passenger_id,
        'reviewee_id' => $booking->ride->driver_id,
        'type'        => 'passenger_to_driver',
      ]);

      // Le conducteur note le passager (70% du temps)
      if (rand(1, 10) <= 7) {
        Review::factory()->create([
          'booking_id'  => $booking->id,
          'reviewer_id' => $booking->ride->driver_id,
          'reviewee_id' => $booking->passenger_id,
          'type'        => 'driver_to_passenger',
        ]);
      }
    }
  }
}

<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $bookings = Booking::whereIn('status', ['confirmed', 'completed'])->get();

    foreach ($bookings as $booking) {
      Payment::factory()->create([
        'booking_id' => $booking->id,
        'payer_id'   => $booking->passenger_id,
        'amount'     => $booking->total_price,
      ]);
    }
  }
}

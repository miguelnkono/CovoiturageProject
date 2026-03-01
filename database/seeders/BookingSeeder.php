<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Location;
use App\Models\Ride;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $passengers = User::whereIn('role', ['passenger', 'both'])->get();
      $rides      = Ride::all();
      $locations  = Location::all();

      foreach ($rides as $ride) {
        $bookingCount = rand(1, min(3, $ride->seats_available));

        for ($i = 0; $i < $bookingCount; $i++) {
          $passenger = $passengers->random();

          // Éviter les doublons conducteur-passager
          if ($passenger->id === $ride->driver_id) continue;

          $status = $ride->status === 'completed' ? 'completed' : 'confirmed';

          Booking::factory()->create([
            'ride_id'             => $ride->id,
            'passenger_id'        => $passenger->id,
            'pickup_location_id'  => $locations->random()->id,
            'dropoff_location_id' => $locations->random()->id,
            'status'              => $status,
            'total_price'         => $ride->price_per_seat,
          ]);
        }
      }

      // Quelques réservations annulées
      Booking::factory(10)->cancelled()->create();
    }
}

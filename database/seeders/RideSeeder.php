<?php

namespace Database\Seeders;

use App\Models\Location;
use App\Models\Ride;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RideSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $drivers   = User::whereIn('role', ['driver', 'both'])->get();
    $locations = Location::all();

    foreach ($drivers as $driver) {
      $vehicle = Vehicle::whereHas('driver', fn($q) => $q->where('user_id', $driver->id))->first();

      if (! $vehicle) continue;

      // 2-4 trajets à venir par conducteur
      $count = rand(2, 4);
      for ($i = 0; $i < $count; $i++) {
        $origin      = $locations->random();
        $destination = $locations->where('id', '!=', $origin->id)->random();

        Ride::factory()->published()->create([
          'driver_id'      => $driver->id,
          'vehicle_id'     => $vehicle->id,
          'origin_id'      => $origin->id,
          'destination_id' => $destination->id,
        ]);
      }

      // 1-2 trajets passés (terminés)
      $past = rand(1, 2);
      for ($i = 0; $i < $past; $i++) {
        $origin      = $locations->random();
        $destination = $locations->where('id', '!=', $origin->id)->random();

        Ride::factory()->completed()->create([
          'driver_id'      => $driver->id,
          'vehicle_id'     => $vehicle->id,
          'origin_id'      => $origin->id,
          'destination_id' => $destination->id,
        ]);
      }
    }
  }
}

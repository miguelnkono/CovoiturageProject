<?php

namespace Database\Seeders;

use App\Models\DriverProfile;
use App\Models\Vehicle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $profiles = DriverProfile::all();

      foreach ($profiles as $profile) {
        // 1 à 2 véhicules par conducteur
        $count = rand(1, 2);
        Vehicle::factory($count)->create(['driver_id' => $profile->id]);
      }
    }
}

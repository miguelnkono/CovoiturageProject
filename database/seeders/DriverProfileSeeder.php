<?php

namespace Database\Seeders;

use App\Models\DriverProfile;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DriverProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $drivers = User::whereIn('role', ['driver', 'both'])->get();

      foreach ($drivers as $driver) {
        DriverProfile::factory()->create(['user_id' => $driver->id]);
      }
    }
}

<?php

namespace Database\Seeders;

use App\Models\RideSearch;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RideSearchSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $passengers = User::whereIn('role', ['passenger', 'both'])->get();

    foreach ($passengers as $passenger) {
      RideSearch::factory(rand(1, 3))->create(['user_id' => $passenger->id]);
    }
  }
}

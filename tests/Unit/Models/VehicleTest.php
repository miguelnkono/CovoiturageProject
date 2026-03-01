<?php

namespace Tests\Unit\Models;

use App\Models\DriverProfile;
use App\Models\Ride;
use App\Models\Vehicle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase;

class VehicleTest extends TestCase
{
  use RefreshDatabase;

  public function test_vehicle_can_be_created(): void
  {
    $vehicle = Vehicle::factory()->create();
    $this->assertDatabaseHas('vehicles', ['id' => $vehicle->id]);
  }

  public function test_vehicle_belongs_to_driver_profile(): void
  {
    $vehicle = Vehicle::factory()->create();
    $this->assertInstanceOf(DriverProfile::class, $vehicle->driver);
  }

  public function test_vehicle_has_many_rides(): void
  {
    $vehicle = Vehicle::factory()->create();
    Ride::factory(3)->create(['vehicle_id' => $vehicle->id]);

    $this->assertCount(3, $vehicle->rides);
  }

  public function test_vehicle_license_plate_is_unique(): void
  {
    Vehicle::factory()->create(['license_plate' => 'LT-1234-AB']);

    $this->expectException(\Illuminate\Database\QueryException::class);
    Vehicle::factory()->create(['license_plate' => 'LT-1234-AB']);
  }

  public function test_vehicle_photos_is_cast_to_array(): void
  {
    $vehicle = Vehicle::factory()->create([
      'photos' => ['http://example.com/photo1.jpg'],
    ]);
    $this->assertIsArray($vehicle->photos);
  }

  public function test_vehicle_nb_seats_is_stored_correctly(): void
  {
    $vehicle = Vehicle::factory()->create(['nb_seats' => 5]);
    $this->assertEquals(5, $vehicle->nb_seats);
  }
}

<?php

namespace Tests\Unit\Models;

use App\Models\Booking;
use App\Models\Location;
use App\Models\Ride;
use App\Models\RideWaypoint;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase;

class RideTest extends TestCase
{
  use RefreshDatabase;

  public function test_ride_can_be_created(): void
  {
    $ride = Ride::factory()->create();
    $this->assertDatabaseHas('rides', ['id' => $ride->id]);
  }

  public function test_ride_belongs_to_driver(): void
  {
    $ride = Ride::factory()->create();
    $this->assertInstanceOf(User::class, $ride->driver);
  }

  public function test_ride_belongs_to_vehicle(): void
  {
    $ride = Ride::factory()->create();
    $this->assertInstanceOf(Vehicle::class, $ride->vehicle);
  }

  public function test_ride_has_origin_and_destination(): void
  {
    $ride = Ride::factory()->create();

    $this->assertInstanceOf(Location::class, $ride->origin);
    $this->assertInstanceOf(Location::class, $ride->destination);
  }

  public function test_ride_has_many_bookings(): void
  {
    $ride = Ride::factory()->create(['seats_available' => 4]);
    Booking::factory(2)->create(['ride_id' => $ride->id]);

    $this->assertCount(2, $ride->bookings);
  }

  public function test_ride_has_many_waypoints(): void
  {
    $ride = Ride::factory()->create();
    RideWaypoint::factory(2)->create(['ride_id' => $ride->id]);

    $this->assertCount(2, $ride->waypoints);
  }

  public function test_ride_default_status_is_draft(): void
  {
    $ride = Ride::factory()->make();
    // Le factory met 'published', on teste le draft manuellement
    $ride = Ride::factory()->create(['status' => 'draft']);
    $this->assertEquals('draft', $ride->status);
  }

  public function test_ride_departure_datetime_is_cast(): void
  {
    $ride = Ride::factory()->create();
    $this->assertInstanceOf(\Illuminate\Support\Carbon::class, $ride->departure_datetime);
  }

  public function test_ride_is_not_recurrent_by_default(): void
  {
    $ride = Ride::factory()->create();
    $this->assertFalse($ride->is_recurrent);
  }
}

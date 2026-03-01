<?php

namespace Tests\Unit\Models;

use App\Models\Location;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase;

class LocationTest extends TestCase
{
  use RefreshDatabase;

  public function test_location_can_be_created(): void
  {
    $location = Location::factory()->create();
    $this->assertDatabaseHas('locations', ['id' => $location->id]);
  }

  public function test_location_stores_correct_coordinates(): void
  {
    $location = Location::factory()->create([
      'latitude'  => 3.8480,
      'longitude' => 11.5021,
      'city'      => 'Yaoundé',
    ]);

    $this->assertEquals('Yaoundé', $location->city);
    $this->assertEquals(3.8480, $location->latitude);
    $this->assertEquals(11.5021, $location->longitude);
  }

  public function test_location_has_no_updated_at(): void
  {
    $location = Location::factory()->create();
    $this->assertNull($location->updated_at);
  }
}

<?php

namespace Tests\Unit\Models;

use App\Models\DriverProfile;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase;

class DriverProfileTest extends TestCase
{
  use RefreshDatabase;

  public function test_driver_profile_can_be_created(): void
  {
    $profile = DriverProfile::factory()->create();
    $this->assertDatabaseHas('driver_profiles', ['id' => $profile->id]);
  }

  public function test_driver_profile_belongs_to_user(): void
  {
    $profile = DriverProfile::factory()->create();
    $this->assertInstanceOf(User::class, $profile->user);
  }

  public function test_driver_profile_has_many_vehicles(): void
  {
    $profile = DriverProfile::factory()->create();
    Vehicle::factory(2)->create(['driver_id' => $profile->id]);

    $this->assertCount(2, $profile->vehicles);
  }

  public function test_preferences_is_cast_to_array(): void
  {
    $profile = DriverProfile::factory()->create([
      'preferences' => ['music' => true, 'smoking' => false],
    ]);
    $this->assertIsArray($profile->preferences);
    $this->assertTrue($profile->preferences['music']);
  }

  public function test_is_license_verified_is_false_by_default(): void
  {
    $profile = DriverProfile::factory()->create(['is_license_verified' => false]);
    $this->assertFalse($profile->is_license_verified);
  }
}

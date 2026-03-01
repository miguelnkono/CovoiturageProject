<?php

namespace Tests\Unit\Models;

use App\Models\Booking;
use App\Models\DriverProfile;
use App\Models\Notification;
use App\Models\Ride;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase;

class UserTest extends TestCase
{
  use RefreshDatabase;

  public function test_user_can_be_created(): void
  {
    $user = User::factory()->create();
    $this->assertDatabaseHas('users', ['email' => $user->email]);
  }

  public function test_user_has_uuid_primary_key(): void
  {
    $user = User::factory()->create();
    $this->assertMatchesRegularExpression(
      '/^[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}$/',
      $user->id
    );
  }

  public function test_user_password_is_hidden(): void
  {
    $user = User::factory()->create();
    $this->assertArrayNotHasKey('password', $user->toArray());
  }

  public function test_user_has_driver_profile_relation(): void
  {
    $user    = User::factory()->driver()->create();
    $profile = DriverProfile::factory()->create(['user_id' => $user->id]);

    $this->assertInstanceOf(DriverProfile::class, $user->driverProfile);
  }

  public function test_user_has_many_rides_as_driver(): void
  {
    $user = User::factory()->driver()->create();
    Ride::factory(3)->create(['driver_id' => $user->id]);

    $this->assertCount(3, $user->rides);
  }

  public function test_user_has_many_bookings_as_passenger(): void
  {
    $user = User::factory()->passenger()->create();
    Booking::factory(2)->create(['passenger_id' => $user->id]);

    $this->assertCount(2, $user->bookings);
  }

  public function test_user_has_one_wallet(): void
  {
    $user   = User::factory()->create();
    $wallet = Wallet::factory()->create(['user_id' => $user->id]);

    $this->assertInstanceOf(Wallet::class, $user->wallet);
    $this->assertEquals($wallet->id, $user->wallet->id);
  }

  public function test_user_has_many_notifications(): void
  {
    $user = User::factory()->create();
    Notification::factory(5)->create(['user_id' => $user->id]);

    $this->assertCount(5, $user->notifications);
  }

  public function test_user_email_must_be_unique(): void
  {
    User::factory()->create(['email' => 'test@test.cm']);

    $this->expectException(\Illuminate\Database\QueryException::class);
    User::factory()->create(['email' => 'test@test.cm']);
  }

  public function test_user_is_active_by_default(): void
  {
    $user = User::factory()->create();
    $this->assertTrue($user->is_active);
  }

  public function test_user_is_not_verified_by_default(): void
  {
    $user = User::factory()->unverified()->create();
    $this->assertFalse($user->is_verified);
  }

  public function test_user_date_of_birth_is_cast_to_date(): void
  {
    $user = User::factory()->create(['date_of_birth' => '1990-05-15']);
    $this->assertInstanceOf(\Illuminate\Support\Carbon::class, $user->date_of_birth);
  }
}

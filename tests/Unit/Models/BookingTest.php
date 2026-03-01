<?php

namespace Tests\Unit\Models;

use App\Models\Booking;
use App\Models\Location;
use App\Models\Payment;
use App\Models\Ride;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase;

class BookingTest extends TestCase
{
  use RefreshDatabase;

  public function test_booking_can_be_created(): void
  {
    $booking = Booking::factory()->create();
    $this->assertDatabaseHas('bookings', ['id' => $booking->id]);
  }

  public function test_booking_belongs_to_ride(): void
  {
    $booking = Booking::factory()->create();
    $this->assertInstanceOf(Ride::class, $booking->ride);
  }

  public function test_booking_belongs_to_passenger(): void
  {
    $booking = Booking::factory()->create();
    $this->assertInstanceOf(User::class, $booking->passenger);
  }

  public function test_booking_has_pickup_and_dropoff_locations(): void
  {
    $booking = Booking::factory()->create();

    $this->assertInstanceOf(Location::class, $booking->pickupLocation);
    $this->assertInstanceOf(Location::class, $booking->dropoffLocation);
  }

  public function test_booking_has_one_payment(): void
  {
    $booking = Booking::factory()->confirmed()->create();
    Payment::factory()->create(['booking_id' => $booking->id]);

    $this->assertInstanceOf(Payment::class, $booking->payment);
  }

  public function test_booking_cancelled_at_is_null_by_default(): void
  {
    $booking = Booking::factory()->confirmed()->create();
    $this->assertNull($booking->cancelled_at);
  }

  public function test_booking_cancelled_state(): void
  {
    $booking = Booking::factory()->cancelled()->create();

    $this->assertEquals('cancelled', $booking->status);
    $this->assertNotNull($booking->cancelled_at);
    $this->assertNotNull($booking->cancel_reason);
  }

  public function test_booking_default_seats_booked_is_one(): void
  {
    $booking = Booking::factory()->create(['seats_booked' => 1]);
    $this->assertEquals(1, $booking->seats_booked);
  }
}

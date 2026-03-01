<?php

namespace Tests\Unit\Models;

use App\Models\Booking;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase;

class PaymentTest extends TestCase
{
  use RefreshDatabase;

  public function test_payment_can_be_created(): void
  {
    $payment = Payment::factory()->create();
    $this->assertDatabaseHas('payments', ['id' => $payment->id]);
  }

  public function test_payment_belongs_to_booking(): void
  {
    $payment = Payment::factory()->create();
    $this->assertInstanceOf(Booking::class, $payment->booking);
  }

  public function test_payment_belongs_to_payer(): void
  {
    $payment = Payment::factory()->create();
    $this->assertInstanceOf(User::class, $payment->payer);
  }

  public function test_payment_pending_has_no_paid_at(): void
  {
    $payment = Payment::factory()->pending()->create();

    $this->assertEquals('pending', $payment->status);
    $this->assertNull($payment->paid_at);
  }

  public function test_payment_default_currency_is_xaf(): void
  {
    $payment = Payment::factory()->create();
    $this->assertEquals('XAF', $payment->currency);
  }

  public function test_payment_amount_stored_correctly(): void
  {
    $payment = Payment::factory()->create(['amount' => 5000.00]);
    $this->assertEquals(5000.00, $payment->amount);
  }
}

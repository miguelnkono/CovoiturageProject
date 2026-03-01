<?php

namespace Tests\Unit\Models;

use App\Models\Promo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase;

class PromoTest extends TestCase
{
  use RefreshDatabase;

  public function test_promo_can_be_created(): void
  {
    $promo = Promo::factory()->create();
    $this->assertDatabaseHas('promos', ['code' => $promo->code]);
  }

  public function test_promo_code_is_unique(): void
  {
    Promo::factory()->create(['code' => 'BIENVENUE']);

    $this->expectException(\Illuminate\Database\QueryException::class);
    Promo::factory()->create(['code' => 'BIENVENUE']);
  }

  public function test_promo_is_active_by_default(): void
  {
    $promo = Promo::factory()->create();
    $this->assertTrue($promo->is_active);
  }

  public function test_promo_used_count_starts_at_zero(): void
  {
    $promo = Promo::factory()->create(['used_count' => 0]);
    $this->assertEquals(0, $promo->used_count);
  }

  public function test_expired_promo_is_inactive(): void
  {
    $promo = Promo::factory()->expired()->create();

    $this->assertFalse($promo->is_active);
    $this->assertTrue($promo->expires_at->isPast());
  }

  public function test_promo_percent_discount(): void
  {
    $promo = Promo::factory()->percentDiscount()->create();
    $this->assertEquals('percent', $promo->discount_type);
    $this->assertGreaterThanOrEqual(5, $promo->discount_value);
    $this->assertLessThanOrEqual(30, $promo->discount_value);
  }

  public function test_expires_at_is_cast_to_datetime(): void
  {
    $promo = Promo::factory()->create(['expires_at' => '2025-12-31 23:59:59']);
    $this->assertInstanceOf(\Illuminate\Support\Carbon::class, $promo->expires_at);
  }
}

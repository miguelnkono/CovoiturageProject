<?php

namespace Tests\Unit\Models;

use App\Models\User;
use App\Models\Wallet;
use App\Models\WalletTransaction;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase;

class WalletTest extends TestCase
{
  use RefreshDatabase;

  public function test_wallet_can_be_created(): void
  {
    $wallet = Wallet::factory()->create();
    $this->assertDatabaseHas('wallets', ['id' => $wallet->id]);
  }

  public function test_wallet_belongs_to_user(): void
  {
    $wallet = Wallet::factory()->create();
    $this->assertInstanceOf(User::class, $wallet->user);
  }

  public function test_wallet_has_many_transactions(): void
  {
    $wallet = Wallet::factory()->create();
    WalletTransaction::factory(4)->create(['wallet_id' => $wallet->id]);

    $this->assertCount(4, $wallet->transactions);
  }

  public function test_wallet_empty_has_zero_balance(): void
  {
    $wallet = Wallet::factory()->empty()->create();
    $this->assertEquals(0, $wallet->balance);
  }

  public function test_wallet_user_is_unique(): void
  {
    $user = User::factory()->create();
    Wallet::factory()->create(['user_id' => $user->id]);

    $this->expectException(QueryException::class);
    Wallet::factory()->create(['user_id' => $user->id]);
  }
}

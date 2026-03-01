<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Wallet;
use App\Models\WalletTransaction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WalletSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $users = User::all();

    foreach ($users as $user) {
      $wallet = Wallet::factory()->create(['user_id' => $user->id]);

      // 3-8 transactions par wallet
      WalletTransaction::factory(rand(3, 8))->create(['wallet_id' => $wallet->id]);
    }
  }
}

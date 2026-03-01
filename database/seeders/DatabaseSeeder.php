<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  public function run(): void
  {
    $this->call([
      UserSeeder::class,
      DriverProfileSeeder::class,
      VehicleSeeder::class,
      LocationSeeder::class,
      RideSeeder::class,
      BookingSeeder::class,
      PaymentSeeder::class,
      WalletSeeder::class,
      WalletTransactionSeeder::class,
      ReviewSeeder::class,
      ConversationSeeder::class,
      NotificationSeeder::class,
      RideSearchSeeder::class,
      ReportSeeder::class,
      PromoSeeder::class,
    ]);
  }
}

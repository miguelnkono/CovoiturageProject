<?php

namespace Database\Seeders;

use App\Models\Promo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PromoSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
// Promos fixes connues
    Promo::create([
      'code'           => 'BIENVENUE',
      'discount_type'  => 'percent',
      'discount_value' => 10,
      'max_uses'       => 1000,
      'used_count'     => 0,
      'expires_at'     => now()->addYear(),
      'is_active'      => true,
    ]);

    Promo::create([
      'code'               => 'NOEL2025',
      'discount_type'      => 'fixed',
      'discount_value'     => 500,
      'min_booking_amount' => 2000,
      'max_uses'           => 200,
      'used_count'         => 0,
      'expires_at'         => now()->addMonths(2),
      'is_active'          => true,
    ]);

    // Promos supplémentaires aléatoires
    Promo::factory(10)->create();

    // Quelques promos expirées
    Promo::factory(5)->expired()->create();
  }
}

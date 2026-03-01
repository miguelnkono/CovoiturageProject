<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    // Compte admin fixe pour les tests
    User::create([
      'first_name'  => 'Admin',
      'last_name'   => 'System',
      'email'       => 'admin@covoiturage.cm',
      'phone'       => '+237600000001',
      'password'    => Hash::make('password'),
      'role'        => 'admin',
      'is_verified' => true,
      'is_active'   => true,
    ]);

    // Compte conducteur fixe
    User::create([
      'first_name'  => 'Jean',
      'last_name'   => 'Dupont',
      'email'       => 'driver@covoiturage.cm',
      'phone'       => '+237600000002',
      'password'    => Hash::make('password'),
      'role'        => 'driver',
      'is_verified' => true,
      'is_active'   => true,
    ]);

    // Compte passager fixe
    User::create([
      'first_name'  => 'Marie',
      'last_name'   => 'Nguembo',
      'email'       => 'passenger@covoiturage.cm',
      'phone'       => '+237600000003',
      'password'    => Hash::make('password'),
      'role'        => 'passenger',
      'is_verified' => true,
      'is_active'   => true,
    ]);

    // Conducteurs aléatoires
    User::factory(20)->driver()->create();

    // Passagers aléatoires
    User::factory(30)->passenger()->create();

    // Utilisateurs mixtes
    User::factory(10)->create();
  }
}

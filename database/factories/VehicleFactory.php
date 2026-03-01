<?php

namespace Database\Factories;

use App\Models\DriverProfile;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicle>
 */
class VehicleFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array
  {
    $brands = ['Toyota', 'Renault', 'Peugeot', 'Honda', 'Hyundai', 'Ford', 'Kia', 'Nissan'];
    $models = ['Corolla', 'Clio', '308', 'Civic', 'Tucson', 'Focus', 'Sportage', 'Qashqai'];
    $colors = ['Blanc', 'Noir', 'Gris', 'Rouge', 'Bleu', 'Argent', 'Vert'];

    return [
      'driver_id'     => DriverProfile::factory(),
      'brand'         => $brand = fake()->randomElement($brands),
      'model'         => fake()->randomElement($models),
      'year'          => fake()->numberBetween(2010, 2024),
      'color'         => fake()->randomElement($colors),
      'license_plate' => strtoupper(fake()->unique()->bothify('LT-####-??')),
      'nb_seats'      => fake()->randomElement([4, 5, 6, 7]),
      'fuel_type'     => fake()->randomElement(['gasoline', 'diesel', 'electric', 'hybrid']),
      'is_verified'   => fake()->boolean(50),
      'photos'        => [fake()->imageUrl(640, 480, 'transport')],
    ];
  }
}

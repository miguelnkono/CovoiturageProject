<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Location>
 */
class LocationFactory extends Factory
{private array $cameroonCities = [
  ['city' => 'Yaoundé',    'lat' =>  3.8480, 'lng' =>  11.5021],
  ['city' => 'Douala',     'lat' =>  4.0511, 'lng' =>   9.7679],
  ['city' => 'Bafoussam',  'lat' =>  5.4737, 'lng' =>  10.4179],
  ['city' => 'Garoua',     'lat' =>  9.3012, 'lng' =>  13.3920],
  ['city' => 'Bamenda',    'lat' =>  5.9597, 'lng' =>  10.1461],
  ['city' => 'Maroua',     'lat' => 10.5914, 'lng' =>  14.3248],
  ['city' => 'Ngaoundéré', 'lat' =>  7.3267, 'lng' =>  13.5836],
  ['city' => 'Bertoua',    'lat' =>  4.5764, 'lng' =>  13.6840],
  ['city' => 'Ebolowa',    'lat' =>  2.9000, 'lng' =>  11.1500],
  ['city' => 'Kribi',      'lat' =>  2.9393, 'lng' =>   9.9073],
];

  /**
   *
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array
  {
    $location = fake()->randomElement($this->cameroonCities);

    return [
      'label'    => $location['city'] . ', Cameroun',
      'city'     => $location['city'],
      'country'  => 'CM',
      'latitude' => $location['lat'] + fake()->randomFloat(4, -0.05, 0.05),
      'longitude'=> $location['lng'] + fake()->randomFloat(4, -0.05, 0.05),
      'place_id' => fake()->optional()->bothify('ChIJ####################'),
    ];
  }
}

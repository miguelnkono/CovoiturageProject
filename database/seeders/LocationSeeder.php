<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
// Lieux fixes et réalistes au Cameroun
    $locations = [
      ['label' => 'Yaoundé, Gare Routière Mvan',     'city' => 'Yaoundé',    'country' => 'CM', 'latitude' =>  3.8167, 'longitude' => 11.5167],
      ['label' => 'Yaoundé, Marché Central',          'city' => 'Yaoundé',    'country' => 'CM', 'latitude' =>  3.8678, 'longitude' => 11.5173],
      ['label' => 'Douala, Gare Routière Bonabéri',   'city' => 'Douala',     'country' => 'CM', 'latitude' =>  4.0534, 'longitude' =>  9.6754],
      ['label' => 'Douala, Akwa',                     'city' => 'Douala',     'country' => 'CM', 'latitude' =>  4.0511, 'longitude' =>  9.7679],
      ['label' => 'Bafoussam, Carrefour Total',       'city' => 'Bafoussam',  'country' => 'CM', 'latitude' =>  5.4737, 'longitude' => 10.4179],
      ['label' => 'Garoua, Centre-ville',             'city' => 'Garoua',     'country' => 'CM', 'latitude' =>  9.3012, 'longitude' => 13.3920],
      ['label' => 'Bamenda, Commercial Avenue',       'city' => 'Bamenda',    'country' => 'CM', 'latitude' =>  5.9597, 'longitude' => 10.1461],
      ['label' => 'Maroua, Grand Marché',             'city' => 'Maroua',     'country' => 'CM', 'latitude' => 10.5914, 'longitude' => 14.3248],
      ['label' => 'Ngaoundéré, Gare Ferroviaire',     'city' => 'Ngaoundéré', 'country' => 'CM', 'latitude' =>  7.3267, 'longitude' => 13.5836],
      ['label' => 'Bertoua, Préfecture',              'city' => 'Bertoua',    'country' => 'CM', 'latitude' =>  4.5764, 'longitude' => 13.6840],
      ['label' => 'Kribi, Plage',                     'city' => 'Kribi',      'country' => 'CM', 'latitude' =>  2.9393, 'longitude' =>  9.9073],
      ['label' => 'Ebolowa, Marché',                  'city' => 'Ebolowa',    'country' => 'CM', 'latitude' =>  2.9000, 'longitude' => 11.1500],
      ['label' => 'Limbé, Carrefour',                 'city' => 'Limbé',      'country' => 'CM', 'latitude' =>  4.0167, 'longitude' =>  9.2000],
      ['label' => 'Buea, Mile 17 Motor Park',         'city' => 'Buea',       'country' => 'CM', 'latitude' =>  4.1527, 'longitude' =>  9.2432],
      ['label' => 'Dschang, Université',              'city' => 'Dschang',    'country' => 'CM', 'latitude' =>  5.4497, 'longitude' =>  9.9942],
    ];

    foreach ($locations as $location) {
      Location::create($location);
    }

    // Lieux supplémentaires aléatoires
    Location::factory(20)->create();
  }
}

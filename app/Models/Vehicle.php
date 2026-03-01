<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;

class Vehicle extends Model
{
  use HasFactory, Notifiable, HasUuids;
  use HasUuids;

  protected $fillable = [
    'driver_id', 'brand', 'model', 'year', 'color',
    'license_plate', 'nb_seats', 'fuel_type', 'is_verified', 'photos',
  ];

  protected function casts(): array
  {
    return [
      'is_verified' => 'boolean',
      'photos'      => 'array',
    ];
  }

  public function driver(): BelongsTo
  {
    return $this->belongsTo(DriverProfile::class, 'driver_id');
  }

  public function rides(): HasMany
  {
    return $this->hasMany(Ride::class);
  }
}

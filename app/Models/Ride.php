<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Notifications\Notifiable;

class Ride extends Model
{
  use HasFactory, Notifiable, HasUuids;

  protected $fillable = [
    'driver_id', 'vehicle_id', 'origin_id', 'destination_id',
    'departure_datetime', 'arrival_datetime', 'distance_km',
    'duration_min', 'seats_available', 'seats_total', 'price_per_seat',
    'status', 'description', 'is_recurrent', 'recurrence_rule', 'co2_saved_kg',
  ];

  protected function casts(): array
  {
    return [
      'departure_datetime' => 'datetime',
      'arrival_datetime'   => 'datetime',
      'is_recurrent'       => 'boolean',
    ];
  }

  public function driver(): BelongsTo
  {
    return $this->belongsTo(User::class, 'driver_id');
  }

  public function vehicle(): BelongsTo
  {
    return $this->belongsTo(Vehicle::class);
  }

  public function origin(): BelongsTo
  {
    return $this->belongsTo(Location::class, 'origin_id');
  }

  public function destination(): BelongsTo
  {
    return $this->belongsTo(Location::class, 'destination_id');
  }

  public function waypoints(): HasMany
  {
    return $this->hasMany(RideWaypoint::class)->orderBy('order');
  }

  public function bookings(): HasMany
  {
    return $this->hasMany(Booking::class);
  }
}

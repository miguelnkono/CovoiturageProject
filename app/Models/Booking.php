<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Notifications\Notifiable;

class Booking extends Model
{
  use HasFactory, Notifiable, HasUuids;

  protected $fillable = [
    'ride_id', 'passenger_id', 'seats_booked',
    'pickup_location_id', 'dropoff_location_id',
    'status', 'total_price', 'cancelled_at', 'cancel_reason'
  ];

  protected function casts(): array
  {
    return [
      'cancelled_at' => 'datetime',
    ];
  }

  public function ride(): BelongsTo
  {
    return $this->belongsTo(Ride::class);
  }

  public function passenger(): BelongsTo
  {
    return $this->belongsTo(User::class, 'passenger_id');
  }

  public function pickupLocation(): BelongsTo
  {
    return $this->belongsTo(Location::class, 'pickup_location_id');
  }

  public function dropoffLocation(): BelongsTo
  {
    return $this->belongsTo(Location::class, 'dropoff_location_id');
  }

  public function payment(): HasOne
  {
    return $this->hasOne(Payment::class);
  }

  public function review(): HasMany
  {
    return $this->hasMany(Review::class);
  }

  public function conversation(): HasOne
  {
    return $this->hasOne(Conversation::class);
  }
}

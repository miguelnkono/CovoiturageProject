<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;

class RideWaypoint extends Model
{
  use HasFactory, Notifiable, HasUuids;

  public $timestamps = false;
  protected $fillable = [
    'ride_id', 'location_id', 'order',
    'arrival_time', 'departure_time',
  ];

  protected function casts(): array
  {
    return [
      'arrival_time' => 'datetime',
      'departure_time' => 'datetime',
    ];
  }

  public function ride(): BelongsTo
  {
    return $this->belongsTo(Ride::class);
  }

  public function location(): BelongsTo
  {
    return $this->belongsTo(Location::class);
  }
}

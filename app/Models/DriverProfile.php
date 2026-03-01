<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;

class DriverProfile extends Model
{
  use HasFactory, Notifiable, HasUuids;

  protected $fillable = [
    'user_id', 'license_number', 'license_expiry',
    'is_license_verified', 'years_of_experience', 'preferences',
  ];

  protected function casts(): array
  {
    return [
      'license_expiry' => 'date',
      'is_license_verified' => 'boolean',
      'preferences' => 'array',
    ];
  }

  public function user(): BelongsTo
  {
    return $this->belongsTo(User::class);
  }

  public function vehicles(): HasMany
  {
    return $this->hasMany(Vehicle::class, 'driver_id');
  }
}

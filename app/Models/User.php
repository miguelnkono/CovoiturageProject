<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
  /** @use HasFactory<\Database\Factories\UserFactory> */
  use HasFactory, Notifiable, HasUuids;

  /**
   * The attributes that are mass assignable.
   *
   * @var list<string>
   */
  protected $fillable = [
    'first_name', 'last_name', 'email', 'password',
    'avatar_url', 'date_of_birth', 'gender', 'bio',
    'is_verified', 'is_active', 'role', 'rating_avg',
    'rating_count',
  ];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var list<string>
   */
  protected $hidden = [
    'password',
    'remember_token',
  ];

  /**
   * Get the attributes that should be cast.
   *
   * @return array<string, string>
   */
  protected function casts(): array
  {
    return [
      'date_of_birth' => 'date',
      'is_verified' => 'boolean',
      'is_active' => 'boolean',
      'email_verified_at' => 'datetime',
      'password' => 'hashed',
    ];
  }

  public function driverProfile(): HasOne
  {
    return $this->hasOne(DriverProfile::class);
  }
  public function rides(): HasMany
  {
    return $this->hasMany(Ride::class, 'driver_id');
  }
  public function bookings(): HasMany
  { return $this->hasMany(Booking::class, 'passenger_id'); }
  public function wallet(): HasOne
  { return $this->hasOne(Wallet::class); }
  public function notifications(): HasMany  { return $this->hasMany(Notification::class); }
  public function reviews(): HasMany
  { return $this->hasMany(Review::class, 'reviewer_id'); }
  public function reports(): HasMany
  { return $this->hasMany(Report::class, 'reporter_id'); }
  public function rideSearches(): HasMany
  { return $this->hasMany(RideSearch::class); }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Promo extends Model
{
  use HasFactory, Notifiable, HasUuids;

  public $timestamps = false;
  const string CREATED_AT = 'created_at';
  const string|null UPDATED_AT = null;

  protected $fillable = [
    'code', 'discount_type', 'discount_value', 'min_booking_amount',
    'max_uses', 'used_count', 'expires_at', 'is_active',
  ];

  protected function casts(): array
  {
    return [
      'expires_at' => 'datetime',
      'is_active'  => 'boolean',
    ];
  }
}

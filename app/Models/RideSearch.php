<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;

class RideSearch extends Model
{
  use HasFactory, Notifiable, HasUuids;

  public $timestamps = false;
  const string CREATED_AT = 'created_at';
  const string|null UPDATED_AT = null;

  protected $fillable = [
    'user_id', 'origin_id', 'destination_id',
    'desired_date', 'seats_needed', 'max_price', 'is_alert_active',
  ];

  protected $casts = [
    'desired_date'    => 'date',
    'is_alert_active' => 'boolean',
  ];

  public function user(): BelongsTo
  { return $this->belongsTo(User::class); }
  public function origin(): BelongsTo
  { return $this->belongsTo(Location::class, 'origin_id'); }
  public function destination(): BelongsTo
  { return $this->belongsTo(Location::class, 'destination_id'); }
}

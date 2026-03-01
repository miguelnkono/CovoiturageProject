<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;

class Payment extends Model
{
  use HasFactory, Notifiable, HasUuids;

  public $timestamps = false;
  const string CREATED_AT = 'create_at';
  const string|null UPDATED_AT = null;

  protected $fillable = [
    'booking_id', 'payer_id', 'amount',
    'currency', 'method', 'status', 'transaction_id',
    'paid_at',
  ];

  protected function casts(): array
  {
    return [
      'paid_at' => 'datetime',
    ];
  }

  public function booking(): BelongsTo
  {
    return $this->belongsTo(Booking::class);
  }

  public function payer(): BelongsTo
  {
    return $this->belongsTo(User::class, 'payer_id');
  }
}

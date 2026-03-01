<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;

class WalletTransaction extends Model
{
  use HasFactory, Notifiable, HasUuids;

  public $timestamps = false;
  const string CREATED_AT = 'create_at';
  const string|null UPDATED_AT = null;

  protected $fillable = [
    'wallet_id', 'type', 'amount',
    'description', 'reference_id',
  ];

  public function wallet(): BelongsTo
  {
    return $this->belongsTo(Wallet::class);
  }
}

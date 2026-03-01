<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;

class Wallet extends Model
{
  use HasFactory, Notifiable, HasUuids;

  protected $fillable = [ 'user_id', 'balance', 'currency' ];

  public function user(): BelongsTo
  {
    return $this->belongsTo(User::class);
  }

  public function transactions(): HasMany
  {
    return $this->hasMany(WalletTransaction::class);
  }
}

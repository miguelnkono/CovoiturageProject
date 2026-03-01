<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;

class Conversation extends Model
{
  use HasFactory, Notifiable, HasUuids;

  public $timestamps = false;
  const string CREATED_AT = 'created_at';
  const string|null UPDATED_AT = null;

  protected $fillable = ['ride_id', 'booking_id'];

  public function ride(): BelongsTo
  { return $this->belongsTo(Ride::class); }
  public function booking(): BelongsTo
  { return $this->belongsTo(Booking::class); }
  public function messages(): HasMany
  { return $this->hasMany(Message::class); }

  public function participants(): HasMany
  {
    return $this->hasMany(ConversationParticipant::class);
  }

}

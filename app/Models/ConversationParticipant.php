<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;

class ConversationParticipant extends Model
{
  use HasFactory, Notifiable, HasUuids;

  public $timestamps = false;

  protected $fillable = [
    'conversation_id', 'user_id', 'joined_at',
  ];

  public function conversation(): BelongsTo
  {
    return $this->belongsTo(Conversation::class);
  }

  public function user(): BelongsTo
  {
    return $this->belongsTo(User::class);
  }
}

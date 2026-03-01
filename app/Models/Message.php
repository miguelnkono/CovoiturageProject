<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;

class Message extends Model
{
  use HasFactory, Notifiable, HasUuids;

  public $timestamps = false;
  const string CREATED_AT = 'created_at';
  const string|null UPDATED_AT = null;

  protected $fillable = ['conversation_id', 'sender_id', 'content', 'is_read',];
  protected $casts = ['is_read' => 'boolean'];

  public function conversation(): BelongsTo
  { return $this->belongsTo(Conversation::class); }
  public function sender(): BelongsTo
  { return $this->belongsTo(User::class, 'sender_id'); }
}

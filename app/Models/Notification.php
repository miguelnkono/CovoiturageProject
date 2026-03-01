<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;

class Notification extends Model
{
  use HasFactory, Notifiable, HasUuids;

  public $timestamps = false;
  const string CREATED_AT = 'created_at';
  const string|null UPDATED_AT = null;

  protected $fillable = ['user_id', 'type', 'title', 'body', 'is_read', 'data'];
  protected $casts = ['is_read' => 'boolean', 'data' => 'array'];

  public function user(): BelongsTo
  { return $this->belongsTo(User::class); }
}

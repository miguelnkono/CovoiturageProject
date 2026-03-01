<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;

class Report extends Model
{
  use HasFactory, Notifiable, HasUuids;

  public $timestamps = false;
  const string CREATED_AT = 'created_at';
  const string|null UPDATED_AT = null;

  protected $fillable = [
    'reporter_id', 'reported_user_id', 'ride_id',
    'reason', 'description', 'status',
  ];

  public function reporter(): BelongsTo
  { return $this->belongsTo(User::class, 'reporter_id'); }
  public function reportedUser(): BelongsTo
  { return $this->belongsTo(User::class, 'reported_user_id'); }
  public function ride(): BelongsTo
  { return $this->belongsTo(Ride::class); }
}

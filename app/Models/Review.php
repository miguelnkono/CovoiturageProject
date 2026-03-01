<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;

class Review extends Model
{
  use HasFactory, Notifiable, HasUuids;

  public $timestamps = false;
  const string CREATED_AT = 'create_at';
  const string|null UPDATED_AT = null;

  protected $fillable = [
    'booking_id', 'reviewer_id', 'reviewee_id',
    'rating', 'comment', 'type',
  ];

  public function booking(): BelongsTo
  {
    return $this->belongsTo(Booking::class);
  }

  public function reviewer(): BelongsTo
  {
    return $this->belongsTo(User::class, 'reviewer_id');
  }

  public function reviewee(): BelongsTo
  {
    return $this->belongsTo(User::class, 'reviewee_id');
  }
}

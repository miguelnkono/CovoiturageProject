<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Location extends Model
{
  use HasFactory, Notifiable, HasUuids;

  public $timestamps = false;
  protected $fillable = [
    'label',
    'city',
    'country',
    'latitude',
    'longitude',
    'place_id',
  ];

  const string CREATED_AT = 'created_at';
  const string|null UPDATED_AT = null;
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('rides', function (Blueprint $table) {
      $table->uuid('id')->primary();
      $table->foreignUuid('driver_id')->constrained('users')->cascadeOnDelete();
      $table->foreignUuid('vehicle_id')->constrained()->cascadeOnDelete();
      $table->foreignUuid('origin_id')->constrained('locations');
      $table->foreignUuid('destination_id')->constrained('locations');
      $table->dateTime('departure_datetime');
      $table->dateTime('arrival_datetime')->nullable();
      $table->float('distance_km')->nullable();
      $table->integer('duration_min')->nullable();
      $table->integer('seats_available');
      $table->integer('seats_total');
      $table->decimal('price_per_seat', 10, 2);
      $table->enum('status', ['draft', 'published', 'full', 'ongoing', 'completed', 'cancelled'])
        ->default('draft');
      $table->text('description')->nullable();
      $table->boolean('is_recurrent')->default(false);
      $table->string('recurrence_rule')->nullable();
      $table->float('co2_saved_kg')->nullable();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('rides');
  }
};

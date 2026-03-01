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
    Schema::create('notifications', function (Blueprint $table) {
      $table->uuid('id')->primary();
      $table->foreignUuid('user_id')->constrained()->onDelete('cascade');
      $table->enum('type', [
        'booking_confirmed', 'ride_cancelled', 'new_message',
        'payment_received', 'review_received', 'ride_starting'
      ]);
      $table->string('title');
      $table->text('body');
      $table->boolean('is_read')->default(false);
      $table->json('data')->nullable();
      $table->timestamp('created_at')->useCurrent();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('notifications');
  }
};

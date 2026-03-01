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
    Schema::create('promos', function (Blueprint $table) {
      $table->uuid('id')->primary();
      $table->string('code')->unique();
      $table->enum('discount_type', ['percent', 'fixed']);
      $table->decimal('discount_value', 10, 2);
      $table->decimal('min_booking_amount', 10, 2)->nullable();
      $table->integer('max_uses')->nullable();
      $table->integer('used_count')->default(0);
      $table->dateTime('expires_at')->nullable();
      $table->boolean('is_active')->default(true);
      $table->timestamp('created_at')->useCurrent();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('promos');
  }
};

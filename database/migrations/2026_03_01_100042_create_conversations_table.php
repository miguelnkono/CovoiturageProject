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
    Schema::create('conversations', function (Blueprint $table) {
      $table->uuid('id')->primary();
      $table->foreignUuid('ride_id')->constrained()->onDelete('cascade');
      $table->foreignUuid('booking_id')->nullable()->constrained()->onDelete('set null');
      $table->timestamp('created_at')->useCurrent();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('conversations');
  }
};

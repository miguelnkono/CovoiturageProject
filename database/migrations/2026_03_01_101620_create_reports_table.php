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
    Schema::create('reports', function (Blueprint $table) {
      $table->uuid('id')->primary();
      $table->foreignUuid('reporter_id')->constrained('users');
      $table->foreignUuid('reported_user_id')->constrained('users');
      $table->foreignUuid('ride_id')->nullable()->constrained()->onDelete('set null');
      $table->enum('reason', ['harassment', 'fraud', 'no_show', 'dangerous_driving', 'other']);
      $table->text('description')->nullable();
      $table->enum('status', ['pending', 'reviewed', 'resolved'])->default('pending');
      $table->timestamp('created_at')->useCurrent();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('reports');
  }
};

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
    Schema::create('wallet_transactions', function (Blueprint $table) {
      $table->uuid('id')->primary();
      $table->foreignUuid('wallet_id')->constrained()->onDelete('cascade');
      $table->enum('type', ['credit', 'debit', 'refund', 'withdrawal']);
      $table->decimal('amount', 10, 2);
      $table->text('description')->nullable();
      $table->uuid('reference_id')->nullable();
      $table->timestamp('created_at')->useCurrent();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('wallet_transactions');
  }
};

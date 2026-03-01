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
    Schema::create('payments', function (Blueprint $table) {
      $table->uuid('id')->primary();
      $table->foreignUuid('booking_id')->constrained()->onDelete('cascade');
      $table->foreignUuid('payer_id')->constrained('users');
      $table->decimal('amount', 10, 2);
      $table->string('currency', 10)->default('XAF');
      $table->enum('method', ['card', 'mobile_money', 'wallet', 'cash']);
      $table->enum('status', ['pending', 'paid', 'refunded', 'failed'])->default('pending');
      $table->string('transaction_id')->nullable();
      $table->dateTime('paid_at')->nullable();
      $table->timestamp('created_at')->useCurrent();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('payments');
  }
};

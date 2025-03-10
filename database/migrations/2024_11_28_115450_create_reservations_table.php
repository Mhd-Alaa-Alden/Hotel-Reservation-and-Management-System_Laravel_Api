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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete('')->cascadeOnUpdate();
            $table->string('guest_name')->nullable();
            $table->string('guest_email')->nullable();
            $table->string('guest_phone')->nullable();
            $table->float('total_amount');
            $table->text('notes')->nullable();
            $table->enum('Reservation_status', ['CONFIRMED', 'CANCELLED', 'COMPLETED']);
            $table->enum('services_requested', ['YES', 'NO']);
            $table->enum('payment_method', ['CASH', 'CREDIT_CARD', 'BANK_TRANSFER']);
            $table->enum('payment_status', ['PENDING', 'COMPLETED', 'FAILED', 'REFUNDED']); //
            $table->string('payment_reference')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};

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
        Schema::create('financialmanagements', function (Blueprint $table) {
            $table->id();
            $table->enum('category', ['revenue', 'expense']);
            $table->enum('source', ['Reservations', 'Services', 'other'])->default('Reservations');
            $table->float('amount');
            $table->float('total_amount');
            $table->string('description')->nullable();
            $table->date('transaction_date');
            $table->index(['category', 'source']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('financialmanagements');
    }
};

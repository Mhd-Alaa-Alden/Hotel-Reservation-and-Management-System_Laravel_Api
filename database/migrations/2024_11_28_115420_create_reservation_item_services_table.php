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
        Schema::create('reservation_item_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('services_id')->constrained('services')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('reservation_items_id')->constrained('reservation_items')->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer('service_price');
            $table->unsignedInteger('quantity');
            $table->float('subtotal_services');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservation_item_services');
    }
};

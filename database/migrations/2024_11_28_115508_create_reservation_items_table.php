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
        Schema::create('reservation_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reservation_id')->constrained('reservations')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('room_id')->constrained('rooms')->cascadeOnDelete()->cascadeOnUpdate();
            $table->date('check_in_date');
            $table->date('check_out_date');
            $table->unsignedInteger('children_count');
            $table->unsignedInteger('adults_count');
            $table->float('room_price');
            $table->unsignedInteger('number_of_nights');
            $table->float('subtotal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservation_items');
    }
};

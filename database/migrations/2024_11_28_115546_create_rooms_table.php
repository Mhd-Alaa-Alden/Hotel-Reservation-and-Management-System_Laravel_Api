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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('categorys')->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer('room_number');
            $table->integer('capacity');
            $table->integer('floor');
            $table->integer('bathroom');
            $table->float('price');
            $table->string('images');
            $table->text('description')->nullable();
            $table->enum('AvailabilityStatus', ['AVAILABLE ', 'RESERVED', 'OCCUPIED', 'MAINTENANCE', 'OUT_OF_SERVICE'])->default('AVAILABLE');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};

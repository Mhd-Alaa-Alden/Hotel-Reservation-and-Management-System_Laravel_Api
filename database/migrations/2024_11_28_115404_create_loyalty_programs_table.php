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
        Schema::create('loyalty_programs', function (Blueprint $table) {
            $table->id();
            $table->enum('LevelName', ['Bronze', 'Silver', 'Gold'])->default('Bronze');
            $table->enum('condition_type', ['points', 'spending', 'visits'])->default('points');
            $table->integer('condition_value')->default(0);
            $table->string('additional_services')->nullable();
            $table->float('discount_rate')->default(10);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loyalty_programs');
    }
};

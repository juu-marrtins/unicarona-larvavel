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
        Schema::create('race_passenger', function (Blueprint $table) {
            $table->id();
            $table->foreignId('race_id')
                ->constrained('races')
                ->onDelete('cascade');
            $table->foreignId('passenger_id')
                ->constrained('users')
                ->onDelete('cascade');
            $table->decimal('price', 10, 2);
            $table->enum('status', ['requested', 'accepted', 'refused', 'cancelled','completed'])
                ->default('requested');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('race_passenger');
    }
};

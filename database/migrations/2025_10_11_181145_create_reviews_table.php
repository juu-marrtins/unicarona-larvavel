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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('driver_id')
                ->constrained('users')
                ->onDelete('cascade');
            $table->foreignId('race_id')
                ->constrained('races')
                ->onDelete('cascade');
            $table->foreignId('passenger_id')
                ->constrained('users')
                ->onDelete('cascade');
            $table->text('comment')
                ->nullable();
            $table->integer('rating')
                ->default(5);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};

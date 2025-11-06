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
        Schema::create('races', function (Blueprint $table) {
            $table->id();
            $table->foreignId('driver_id')
                ->constrained('users')
                ->onDelete('cascade');
            $table->foreignId('vehicle_id')
                ->constrained('vehicles')
                ->onDelete('cascade');
            $table->foreignId('origin_id')
                ->constrained('addresses')
                ->onDelete('cascade');
            $table->foreignId('destination_id')
                ->constrained('addresses')
                ->onDelete('cascade');
            $table->time('departure_time');
            $table->time('arrival_time');
            $table->integer('total_seats')
                ->default(4);
            $table->integer('available_seats')
                ->default(4);
            $table->decimal('suggested_value', 10, 2)
                ->nullable();
            $table->text('notes')
                ->nullable();
            $table->enum('status', ['available', 'in_progress', 'finished', 'cancelled'])
                ->default('available'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('races');
    }
};

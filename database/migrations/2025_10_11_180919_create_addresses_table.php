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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->string('street', 100);
            $table->string('number', 100);
            $table->string('complement', 100)
                ->nullable();
            $table->string('district', 100);
            $table->string('city', 100);
            $table->string('state', 100);
            $table->string('cep', 8)
                ->nullable();
            $table->decimal('latitude', 10, 8)
                ->nullable();
            $table->decimal('longitude', 10, 8)
                ->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};

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
        Schema::table('users', function (Blueprint $table) {
            $table->string('email_institutional', 100)
                ->unique();
            $table->string('RA', 100)
                ->unique();
            $table->string('phone', 11)
                ->unique();
            $table->text('photo')
                ->nullable();
            $table->enum('user_title', ['student', 'teacher', 'employee'])
                ->default('student');
            $table->enum('user_type', ['passenger', 'driver', 'employee'])
                ->default('passenger');
            $table->enum('status', ['verified', 'rejected', 'pending'])
                ->default('pending');   
            $table->string('cpf', 11)
                ->unique();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'email_institutional',
                'RA',
                'phone',
                'photo',
                'user_title',
                'user_type',
                'status',
                'cpf',
            ]);
        });
    }
};

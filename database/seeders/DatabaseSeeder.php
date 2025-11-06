<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $institutions = \App\Models\Institution::factory()
            ->count(rand(3, 5))
            ->create();

        \App\Models\User::factory()
            ->count(10)
            ->create([
                'institution_id' => fn() => $institutions->random()->id
            ]);

        \App\Models\Vehicle::factory()
            ->count(rand(3, 5))
            ->create([
                'user_id' => fn() => \App\Models\User::factory()->create()->id
            ]);

        \App\Models\Address::factory()
            ->count(rand(3, 5))
            ->create();
    }
}

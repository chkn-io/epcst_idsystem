<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Administrator',
            'email' => 'admin',
            'role' => 'admin'
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Guard 1',
            'email' => 'guard1',
            'role' => 'guard'
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Guard 2',
            'email' => 'guard2',
            'role' => 'guard'
        ]);
    }
}

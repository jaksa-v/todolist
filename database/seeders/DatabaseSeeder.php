<?php

namespace Database\Seeders;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        $user->categories()->createMany([
            ['name' => 'Inbox'],
            ['name' => 'Home'],
            ['name' => 'Work'],
        ]);
        User::first()->todos()->saveMany(Todo::factory()->count(10)->make());
    }
}

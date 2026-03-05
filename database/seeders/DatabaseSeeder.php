<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        User::factory()->create([
            'name' => 'Student User',
            'email' => 'student@example.com',
            'password' => bcrypt('password'),
            'role' => 'student',
        ]);

        \App\Models\Event::create([
            'title' => 'Laravel Livewire 101',
            'speaker' => 'Taylor Otwell',
            'location' => 'Room 101',
            'total_seats' => 5,
        ]);

        \App\Models\Event::create([
            'title' => 'Advanced Database Optimization',
            'speaker' => 'Aaron Francis',
            'location' => 'Room 102',
            'total_seats' => 1,
        ]);
    }
}

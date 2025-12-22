<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         // Create a test user
         User::factory()->create([
             'name' => 'Test User',
             'email' => 'test@example.com',
         ]);

         // Create some categories
         // Create some categories
         $this->call(CategorySeeder::class);
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(PerfilSeeder::class);
        $this->call(UserSeeder::class);
        User::factory()->count(100)->create();
    }
}

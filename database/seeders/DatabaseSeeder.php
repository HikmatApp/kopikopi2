<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // ✔ Test user (boleh dihapus kalau tidak perlu)
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            'role' => 'mitra',
        ]);

        // ✔ ADMIN SEEDER (INI YANG DITAMBAH)
        $this->call([
            AdminSeeder::class,
        ]);
    }
}
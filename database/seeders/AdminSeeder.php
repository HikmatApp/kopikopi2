<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin KopiKopi',
            'email' => 'admin@kopikopi.com',
            'password' => Hash::make('Restuibu123'),
            'role' => 'admin'
        ]);
    }
}
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Akun Admin
        User::updateOrCreate(
            ['email' => 'admin@koperasi.test'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('password123'),
                'role' => 'admin',
            ]
        );

        // Akun User / Anggota
        User::updateOrCreate(
            ['email' => 'user@koperasi.test'],
            [
                'name' => 'Aldi Sharon',
                'password' => Hash::make('password123'),
                'role' => 'user',
            ]
        );
    }
}
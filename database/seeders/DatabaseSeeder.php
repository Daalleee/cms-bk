<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'nama' => 'Super Administrator',
                'kata_sandi' => Hash::make('password123'),
                'peran' => 'super_admin',
            ]
        );

        User::updateOrCreate(
            ['email' => 'admin2@gmail.com'],
            [
                'nama' => 'Admin Kontributor',
                'kata_sandi' => Hash::make('password123'),
                'peran' => 'admin',
            ]
        );
    }
}

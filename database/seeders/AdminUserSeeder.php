<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@voting.com'],
            [
                'name' => 'Administrator',
                'email' => 'admin@voting.com',
                'password' => Hash::make('admin123'),
            ]
        );
    }
}

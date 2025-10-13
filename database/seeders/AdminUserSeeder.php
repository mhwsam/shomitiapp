<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@shomiti.local'],
            [
                'name' => 'Admin',
                'role' => 'admin',
                'password' => Hash::make('password'), // change in production
            ]
        );
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Iroda Test User',
            'email' => 'test@igazi.email',
            'password' => Hash::make('password'),
            'is_iroda' => true,
            'is_admin' => false,
        ]);

        User::create([
            'name' => 'Admin Test User',
            'email' => 'admin@igazi.email',
            'password' => Hash::make('password'),
            'is_iroda' => false,
            'is_admin' => true,
        ]);
    }
}

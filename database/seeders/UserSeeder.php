<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'username' => 'billy',
            'email' => 'billy@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'Admin'
        ]);

        User::create([
            'username' => 'dafa',
            'email' => 'dafa@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'User'
        ]);
        User::create([
            'username' => 'kevin',
            'email' => 'kevin@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'User'
        ]);
        User::create([
            'username' => 'fikry',
            'email' => 'fikry@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'User'
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Restaurant;
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

        Restaurant::create([
            'name' => 'Resto 1',
            'address' => 'Jl. Resto 1',
            'category' => 'Makanan',
            'contact' => '08123456789',
            'latitude' => '-6.23456789',
            'longitude' => '106.23456789',
            'image' => 'https://raw.githubusercontent.com/BillyJonathan29/assets-icf/main/head-meja.png',
            'description' => 'Deskripsi Resto 1',

        ]);
    }
}

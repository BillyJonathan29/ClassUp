<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Tour;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

          Tour::create([
            'name' => 'Pantai Pasir Putih',
            'description' => 'Pantai indah dengan pasir putih dan ombak tenang, cocok untuk liburan keluarga.',
            'location' => 'Desa Suka Maju, Kabupaten Laut Biru',
            'latitude' => -6.20000000,
            'longitude' => 106.81666667,
            'category' => 'Alam',
            'price' => 25000,
            'start_time' => '08:00:00',
            'end_time' => '18:00:00',
            'image' => 'images/pantai-pasir-putih.jpg',
        ]);
    }
}

<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\StrukturDanVisi;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        User::create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),  // Ganti dengan password yang diinginkan
        ]);
       
        StrukturDanVisi::create([
            'slug' => 'visi-misi',
            'content' => 'content',
        ]);
        StrukturDanVisi::create([
            'slug' => 'struktur',
            'content' => 'content',
        ]);
    }
}

<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Destination;
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

        Destination::create([
            'name' => 'Danau Tolire',
            'image' => 'images/danau_tolire.jpg',
            'description' => 'Sebuah danau vulkanik yang indah dengan pemandangan yang memukau.',
            'lat' => 0.827170,
            'long' => 127.294600,
            'slug' => 'danau-tolire',
        ]);

        Destination::create([
            'name' => 'Benteng Tolukko',
            'image' => 'images/benteng_tolukko.jpg',
            'description' => 'Sebuah benteng bersejarah peninggalan Portugis yang menawarkan panorama laut yang menakjubkan.',
            'lat' => 0.783388,
            'long' => 127.366074,
            'slug' => 'benteng-tolukko',
        ]);

        Destination::create([
            'name' => 'Pantai Sulamadaha',
            'image' => 'images/pantai_sulamadaha.jpg',
            'description' => 'Pantai dengan air yang sangat jernih dan keindahan alam bawah laut yang menakjubkan.',
            'lat' => 0.815300,
            'long' => 127.309300,
            'slug' => 'pantai-sulamadaha',
        ]);

        Destination::create([
            'name' => 'Gunung Gamalama',
            'image' => 'images/gunung_gamalama.jpg',
            'description' => 'Gunung berapi yang ikonik dan merupakan salah satu daya tarik utama di Ternate.',
            'lat' => 0.808226,
            'long' => 127.325038,
            'slug' => 'gunung-gamalama',
        ]);

        Destination::create([
            'name' => 'Kedaton Sultan Ternate',
            'image' => 'images/kedaton_sultan_ternate.jpg',
            'description' => 'Istana Sultan yang menjadi pusat sejarah dan budaya Ternate.',
            'lat' => 0.794752,
            'long' => 127.372155,
            'slug' => 'kedaton-sultan-ternate',
        ]);
    }
}

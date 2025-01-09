<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Destination;
use App\Models\Ekraf;
use App\Models\EkrafCategories;
use App\Models\StrukturDanVisi;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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


        $categories = [
            [
                'name' => 'Kuliner',
                'icon' => 'bi-cup-hot-fill',
                'description' => 'Kategori untuk bisnis makanan dan minuman'
            ],
            [
                'name' => 'Fashion',
                'icon' => 'bi-bag-fill', 
                'description' => 'Kategori untuk bisnis pakaian dan aksesoris'
            ],
            [
                'name' => 'Kriya',
                'icon' => 'bi-brush-fill',
                'description' => 'Kategori untuk kerajinan tangan'
            ],
            [
                'name' => 'Televisi & Radio',
                'icon' => 'bi-tv-fill',
                'description' => 'Kategori untuk media penyiaran'
            ],
            [
                'name' => 'Penerbitan',
                'icon' => 'bi-book-fill',
                'description' => 'Kategori untuk bisnis penerbitan'
            ],
            [
                'name' => 'Arsitektur',
                'icon' => 'bi-building',
                'description' => 'Kategori untuk jasa arsitektur'
            ],
            [
                'name' => 'Periklanan',
                'icon' => 'bi-megaphone-fill',
                'description' => 'Kategori untuk jasa periklanan'
            ],
            [
                'name' => 'Musik',
                'icon' => 'bi-music-note-beamed',
                'description' => 'Kategori untuk industri musik'
            ],
            [
                'name' => 'Fotografi',
                'icon' => 'bi-camera-fill',
                'description' => 'Kategori untuk jasa fotografi'
            ],
            [
                'name' => 'Seni Pertunjukan',
                'icon' => 'bi-music-player-fill',
                'description' => 'Kategori untuk seni pertunjukan'
            ],
            [
                'name' => 'Desain Produk',
                'icon' => 'bi-box-fill',
                'description' => 'Kategori untuk desain produk'
            ],
            [
                'name' => 'Seni Rupa',
                'icon' => 'bi-palette-fill',
                'description' => 'Kategori untuk seni rupa'
            ],
            [
                'name' => 'Desain Interior',
                'icon' => 'bi-house-door-fill',
                'description' => 'Kategori untuk desain interior'
            ],
            [
                'name' => 'Film, Animasi dan Video',
                'icon' => 'bi-film',
                'description' => 'Kategori untuk industri film dan animasi'
            ],
            [
                'name' => 'DKV',
                'icon' => 'bi-vector-pen',
                'description' => 'Kategori untuk desain komunikasi visual'
            ],
            [
                'name' => 'Aplikasi',
                'icon' => 'bi-phone-fill',
                'description' => 'Kategori untuk pengembangan aplikasi'
            ],
            [
                'name' => 'Game',
                'icon' => 'bi-controller',
                'description' => 'Kategori untuk pengembangan game'
            ]
        ];

        foreach($categories as $category) {
            EkrafCategories::create([
                'name' => $category['name'],
                'slug' => Str::slug($category['name']),
                'description' => $category['description'],
                'icon' => $category['icon']
            ]);
        }

         // Seed Ekraf
         $ekrafs = [
            [
                'name' => 'Warung Nasi Goreng Pak Budi',
                'description' => 'Menyajikan nasi goreng dengan berbagai variasi',
                'category_id' => 1, // Kuliner
                'address' => 'Jl. Pahlawan No. 123, Surabaya',
                'phone' => '081234567890',
                'email' => 'nasigorengpakbudi@gmail.com',
                'website' => 'www.nasigorengpakbudi.com',
                'social_media' => '@nasigorengpakbudi',
                'jumlah_produk' => '10'
            ],
            [
                'name' => 'Butik Elegan',
                'description' => 'Butik fashion wanita dengan desain modern',
                'category_id' => 2, // Fashion
                'address' => 'Jl. Pemuda No. 45, Surabaya',
                'phone' => '081234567891',
                'email' => 'butikelegan@gmail.com',
                'website' => 'www.butikelegan.com',
                'social_media' => '@butikelegan',
                'jumlah_produk' => '50'
            ],
            [
                'name' => 'Kerajinan Bambu Jaya',
                'description' => 'Produk kerajinan tangan dari bambu berkualitas',
                'category_id' => 3, // Kriya
                'address' => 'Jl. Veteran No. 78, Surabaya',
                'phone' => '081234567892',
                'email' => 'bambujaya@gmail.com',
                'website' => 'www.bambujaya.com',
                'social_media' => '@bambujaya',
                'jumlah_produk' => '30'
            ],
            [
                'name' => 'Radio Suara Kota',
                'description' => 'Radio lokal dengan program menarik',
                'category_id' => 4, // Televisi & Radio
                'address' => 'Jl. Sudirman No. 90, Surabaya',
                'phone' => '081234567893',
                'email' => 'suarakota@gmail.com',
                'website' => 'www.radiosuarakota.com',
                'social_media' => '@radiosuarakota',
                'jumlah_produk' => '5'
            ],
            [
                'name' => 'Penerbit Masa Depan',
                'description' => 'Penerbit buku dengan berbagai genre',
                'category_id' => 5, // Penerbitan
                'address' => 'Jl. Diponegoro No. 56, Surabaya',
                'phone' => '081234567894',
                'email' => 'masadepan@gmail.com',
                'website' => 'www.penerbitmasadepan.com',
                'social_media' => '@penerbitmasadepan',
                'jumlah_produk' => '100'
            ],
            [
                'name' => 'Studio Arsitektur Modern',
                'description' => 'Jasa arsitektur dengan pendekatan modern',
                'category_id' => 6, // Arsitektur
                'address' => 'Jl. Majapahit No. 34, Surabaya',
                'phone' => '081234567895',
                'email' => 'studioarsitektur@gmail.com',
                'website' => 'www.studioarsitekturmodern.com',
                'social_media' => '@studioarsitektur',
                'jumlah_produk' => '15'
            ]
        ];

        foreach($ekrafs as $ekraf) {
            Ekraf::create([
                'name' => $ekraf['name'],
                'slug' => Str::slug($ekraf['name']),
                'description' => $ekraf['description'],
                'category_id' => $ekraf['category_id'],
                'address' => $ekraf['address'],
                'phone' => $ekraf['phone'],
                'email' => $ekraf['email'],
                'website' => $ekraf['website'],
                'social_media' => $ekraf['social_media'],
                'jumlah_produk' => $ekraf['jumlah_produk']
            ]);
        }
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ebook extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul', 'penulis', 'deskripsi', 'file', 'gambar_sampul', 
        'jumlah_halaman', 'penerbit', 'tanggal_terbit', 'kategori', 'bahasa', 'kode_buku'
    ];

    public static function boot()
    {
        parent::boot();

        // Event untuk generate kode_buku saat e-book dibuat
        static::creating(function ($ebook) {
            $lastEbook = Ebook::latest('id')->first();
            $nextId = $lastEbook ? $lastEbook->id + 1 : 1;
            $ebook->kode_buku = 'DISPAR-' . str_pad($nextId, 3, '0', STR_PAD_LEFT);
        });
    }

    protected $casts = [
        'tanggal_terbit' => 'date', // Cast ke format tanggal
    ];
}

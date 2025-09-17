<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Kontak extends Model
{
    use HasFactory;

    protected $table = 'kontaks';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama',
        'email',
        'telepon',
        'subjek',
        'pesan',
        'status',
        'tanggal_kontak'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tanggal_kontak' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Status kontak yang tersedia
     */
    public const STATUS_BARU = 'baru';
    public const STATUS_DIBACA = 'dibaca';
    public const STATUS_DIPROSES = 'diproses';
    public const STATUS_SELESAI = 'selesai';

    public static function getStatusOptions()
    {
        return [
            self::STATUS_BARU => 'Baru',
            self::STATUS_DIBACA => 'Dibaca',
            self::STATUS_DIPROSES => 'Diproses',
            self::STATUS_SELESAI => 'Selesai'
        ];
    }

    /**
     * Scope untuk filter berdasarkan status
     */
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope untuk kontak baru
     */
    public function scopeBaru($query)
    {
        return $query->where('status', self::STATUS_BARU);
    }

    /**
     * Scope untuk kontak hari ini
     */
    public function scopeHariIni($query)
    {
        return $query->whereDate('tanggal_kontak', Carbon::today());
    }

    /**
     * Scope untuk kontak minggu ini
     */
    public function scopeMingguIni($query)
    {
        return $query->whereBetween('tanggal_kontak', [
            Carbon::now()->startOfWeek(),
            Carbon::now()->endOfWeek()
        ]);
    }

    /**
     * Accessor untuk format tanggal kontak
     */
    public function getTanggalKontakFormatAttribute()
    {
        return $this->tanggal_kontak->format('d/m/Y H:i');
    }

    /**
     * Accessor untuk status label
     */
    public function getStatusLabelAttribute()
    {
        $statusOptions = self::getStatusOptions();
        return $statusOptions[$this->status] ?? $this->status;
    }

    /**
     * Method untuk menandai sebagai dibaca
     */
    public function markAsDibaca()
    {
        $this->update(['status' => self::STATUS_DIBACA]);
    }

    /**
     * Method untuk menandai sebagai diproses  
     */
    public function markAsDisproses()
    {
        $this->update(['status' => self::STATUS_DIPROSES]);
    }

    /**
     * Method untuk menandai sebagai selesai
     */
    public function markAsSelesai()
    {
        $this->update(['status' => self::STATUS_SELESAI]);
    }

    /**
     * Check apakah kontak masih baru
     */
    public function isBaru()
    {
        return $this->status === self::STATUS_BARU;
    }

    /**
     * Check apakah kontak sudah selesai
     */
    public function isSelesai()
    {
        return $this->status === self::STATUS_SELESAI;
    }
}

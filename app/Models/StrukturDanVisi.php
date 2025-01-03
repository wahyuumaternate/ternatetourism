<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StrukturDanVisi extends Model
{
    use HasFactory;
    protected $table = 'struktur_dan_visi';
    protected $guarded = ['id'];
}

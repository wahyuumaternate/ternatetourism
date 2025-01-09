<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Ekraf extends Model
{
    use HasFactory;
    protected $table = 'ekraf';

    protected $fillable = [
        'name',
        'logo',
        'description',
        'category_id',
        'address',
        'phone',
        'email',
        'website',
        'social_media',
        'slug',
        'jumlah_produk'
    ];

    public function category()
    {
        return $this->belongsTo(EkrafCategories::class);
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->slug = Str::slug($model->name);
        });
    }
}

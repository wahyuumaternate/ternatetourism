<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class EkrafCategories extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'description',
    ];

    public function ekrafs()
    {
        return $this->hasMany(Ekraf::class, 'category_id');
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->slug = Str::slug($model->name);
        });
        static::updating(function ($model) {
            $model->slug = Str::slug($model->name);
        });
    }
}

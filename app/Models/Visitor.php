<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    protected $fillable = [
        'ip',
        'user_agent',
        'latitude',
        'longitude',
        'country',
        'city',
        'page_visited'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable=[
        "title",
        'genre',
        'rating',
        'duration',
        'cast',
        'theatre_id',
        'showtime',
        'image_url',
        'price',
    ];
    use HasFactory;
}

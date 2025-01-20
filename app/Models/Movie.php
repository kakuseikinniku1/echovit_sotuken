<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = [
        'title',
        "lesson",
        "category",
        "user_id",
        'content',
        'movieCount',
        'image',
        'movie',
    ];

}

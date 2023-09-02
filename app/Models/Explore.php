<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Explore extends Model
{
    use HasFactory;

    protected $fillable = [
        'article_cover',
        'tags',
        'title_en',
        'title_ar',
        'content_en',
        'content_ar',
        'date',
        'section'
    ];
}

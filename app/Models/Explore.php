<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Explore extends Model
{
    use HasFactory , SoftDeletes;

    protected $dates = ['deleted_at'];

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

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{

    use HasFactory;

    protected $fillable=[

        'image',
        'category_en',
        'category_ar',
        'title_en',
        'title_ar',
        'content_en',
        'content_ar',
        'image_size'
        ];
}

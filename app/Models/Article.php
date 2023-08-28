<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;



class Article extends Model
{
    use HasFactory;

    protected $fillable=[

        'article_cover',
        'category_en',
        'category_ar',
        'title_en',
        'title_ar',
        'content_en',
        'content_ar',
        'date'
        ];




    //many to many between article and tag
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'articles_tags', 'article_id', 'tag_id')->as('articles_tags');
    }


    //one to many between article and video
    public function videos()
    {
        return $this->hasMany(Image::class, 'article_id', 'id');
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}

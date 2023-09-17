<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsToMany,HasMany,MorphMany};
use Illuminate\Database\Eloquent\{SoftDeletes ,Builder};




class Article extends Model
{
    use HasFactory , SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable=[

        'article_cover',
        'category',
        'title_en',
        'title_ar',
        'sub_title_en',
        'sub_title_ar',
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

    protected $searchable = [
        'category',
        'title_en',
        'title_ar',
        'content_en',
        'content_ar',
    ];

    public function scopeSearch(Builder $builder , string $term){


        foreach ($this->searchable as $searchable){
            $builder->orWhere($searchable , 'like' , "%$term%");
        }

        return $builder;
    }
}

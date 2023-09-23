<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Explore extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'article_cover',
        'category',
        'title_en',
        'title_ar',
        'sub_title_en',
        'sub_title_ar',
        'content_en',
        'content_ar',
        'date',
        'video'

    ];

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
    //many to many between explore and tag
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'explores_tags', 'explore_id', 'tag_id')->as('explores_tags');
    }

    public function videos()
    {
        return $this->morphMany(articleVideo::class, 'videoable');
    }
}

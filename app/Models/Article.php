<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class Article extends Model
{
    use HasFactory;

    protected $fillable=['article_cover' , 'category' , 'title' , 'content' , 'date'];




  //many to many between article and tag
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'articles_tags', 'article_id', 'tag_id');
    }

 //one to many between article and images
    public function images() {
        return $this->hasMany(Image::class , 'article_id' , 'id' );
    }

     //one to many between article and video
     public function videos() {
        return $this->hasMany(Image::class , 'article_id' , 'id' );
    }


}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Food extends Model
{

    use HasFactory;


    protected $fillable=[

        'image',
        'category',
        'title_en',
        'title_ar',
        'content_en',
        'content_ar',
        'image_size'
        ];


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

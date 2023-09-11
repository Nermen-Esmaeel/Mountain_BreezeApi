<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Carbon\Carbon;
use App\Models\Article;
use App\Models\Image;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

       $article =  Article::create([

        'category_en' => 'Article',

        'category_ar' => 'مقالة',

        'title_en'   => 'title1' ,

        'title_ar'   => 'عنوان1' ,

        'content_en'  => 'Lorem Ipsum giving information on its origins as well as'  ,

        'content_ar'  => 'طريقة لكتابة النصوص في النشر والتصميم الجرافيكي تستخدم بشكل شائع'  ,

        'date' => Carbon::parse('2023-09-09'),

    ]);

        $article->tags()->syncWithoutDetaching([
            1
        ]);

        Image::create([
            'image_path' => 'images/blog/1694375023_post.png',
            'imageable_type' => Article::class,
            'imageable_id' => $article->id,
        ]);

    }
}

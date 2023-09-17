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

        'article_cover' => 'images/gallary/1694375023_tech.png',

        'category' => 'Article',


        'title_en'   => 'title1' ,

        'title_ar'   => 'عنوان1' ,


        'sub_title_en'   => 'sub title1',

        'sub_title_ar'   => '1عنوان فرعي ',


        'content_en'  => 'Lorem Ipsum giving information on its origins as well as'  ,

        'content_ar'  => 'طريقة لكتابة النصوص في النشر والتصميم الجرافيكي تستخدم بشكل شائع'  ,

        'date' => Carbon::parse('2023-09-09'),

    ]);

        // $article->tags()->syncWithoutDetaching([
        //     1 ,
        //     2
        // ]);

        Image::create([
            'image_path' => 'images/gallary/1694375023_tech.png',
            'imageable_type' => Article::class,
            'imageable_id' => $article->id,
        ]);

        $article2 =  Article::create([

            'article_cover' => 'images/gallary/1694375023_tech.png',

            'category' => 'Sport',

            'title_en'   => 'title2' ,

            'title_ar'   => 'عنوان2' ,

            'sub_title_en'   => 'sub title2',

            'sub_title_ar'   => '2عنوان فرعي ',

            'content_en'  => 'Lorem Ipsum giving information on its origins as well as'  ,

            'content_ar'  => 'طريقة لكتابة النصوص في النشر والتصميم الجرافيكي تستخدم بشكل شائع'  ,

            'date' => Carbon::parse('2023-09-09'),

        ]);

            // $article2->tags()->syncWithoutDetaching([
            //     3 ,
            //     4
            // ]);

            Image::create([
                'image_path' => 'images/gallary/1694375023_tech.png',
                'imageable_type' => Article::class,
                'imageable_id' => $article2->id,
            ]);
    }
}

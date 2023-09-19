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

        'category' => 'Restaurant',


        'title_en'   => 'title1' ,

        'title_ar'   => 'عنوان1' ,


        'sub_title_en'   => 'sub title1',

        'sub_title_ar'   => '1عنوان فرعي ',


        'content_en'  => 'Lorem Ipsum giving information on its origins as well as'  ,

        'content_ar'  => 'طريقة لكتابة النصوص في النشر والتصميم الجرافيكي تستخدم بشكل شائع'  ,

        'date' => Carbon::parse('2023-09-09'),

    ]);

        Image::create([
            'image_path' => 'images/gallary/1694375023_tech.png',
            'imageable_type' => Article::class,
            'imageable_id' => $article->id,
        ]);

        $article2 =  Article::create([

            'article_cover' => 'images/gallary/1694375023_tech.png',

            'category' => 'Chalet',

            'title_en'   => 'title2' ,

            'title_ar'   => 'عنوان2' ,

            'sub_title_en'   => 'sub title2',

            'sub_title_ar'   => '2عنوان فرعي ',

            'content_en'  => 'Lorem Ipsum giving information on its origins as well as'  ,

            'content_ar'  => 'طريقة لكتابة النصوص في النشر والتصميم الجرافيكي تستخدم بشكل شائع'  ,

            'date' => Carbon::parse('2023-09-09'),

        ]);



            Image::create([
                'image_path' => 'images/gallary/1694375023_tech.png',
                'imageable_type' => Article::class,
                'imageable_id' => $article2->id,
            ]);


            $article3 =  Article::create([

                'article_cover' => 'images/gallary/1694375023_tech.png',

                'category' => 'Activity',

                'title_en'   => 'title3' ,

                'title_ar'   => 'عنوان3' ,

                'sub_title_en'   => 'sub title3',

                'sub_title_ar'   => '3عنوان فرعي ',

                'content_en'  => 'Lorem Ipsum giving information on its origins as well as'  ,

                'content_ar'  => 'طريقة لكتابة النصوص في النشر والتصميم الجرافيكي تستخدم بشكل شائع'  ,

                'date' => Carbon::parse('2023-09-09'),

            ]);
                Image::create([
                    'image_path' => 'images/gallary/1694375023_tech.png',
                    'imageable_type' => Article::class,
                    'imageable_id' => $article3->id,
                ]);


                $article4 =  Article::create([

                    'article_cover' => 'images/gallary/1694375023_tech.png',

                    'category' => 'Nature',

                    'title_en'   => 'title4' ,

                    'title_ar'   => 'عنوان4' ,

                    'sub_title_en'   => 'sub title4',

                    'sub_title_ar'   => '4عنوان فرعي ',

                    'content_en'  => 'Lorem Ipsum giving information on its origins as well as'  ,

                    'content_ar'  => 'طريقة لكتابة النصوص في النشر والتصميم الجرافيكي تستخدم بشكل شائع'  ,

                    'date' => Carbon::parse('2023-09-09'),

                ]);
                    Image::create([
                        'image_path' => 'images/gallary/1694375023_tech.png',
                        'imageable_type' => Article::class,
                        'imageable_id' => $article4->id,
                    ]);

            $article5 =  Article::create([

                'article_cover' => 'images/gallary/1694375023_tech.png',

                'category' => 'Pool',

                'title_en'   => 'title5' ,

                'title_ar'   => 'عنوان5' ,

                'sub_title_en'   => 'sub title5',

                'sub_title_ar'   => '5عنوان فرعي ',

                'content_en'  => 'Lorem Ipsum giving information on its origins as well as'  ,

                'content_ar'  => 'طريقة لكتابة النصوص في النشر والتصميم الجرافيكي تستخدم بشكل شائع'  ,

                'date' => Carbon::parse('2023-09-09'),

            ]);
                Image::create([
                    'image_path' => 'images/gallary/1694375023_tech.png',
                    'imageable_type' => Article::class,
                    'imageable_id' => $article5->id,
                ]);



                $article6 =  Article::create([

                    'article_cover' => 'images/gallary/1694375023_tech.png',

                    'category' => 'Resort Events',

                    'title_en'   => 'title6' ,

                    'title_ar'   => 'عنوان6' ,

                    'sub_title_en'   => 'sub title6',

                    'sub_title_ar'   => '6عنوان فرعي ',

                    'content_en'  => 'Lorem Ipsum giving information on its origins as well as'  ,

                    'content_ar'  => 'طريقة لكتابة النصوص في النشر والتصميم الجرافيكي تستخدم بشكل شائع'  ,

                    'date' => Carbon::parse('2023-09-09'),

                ]);
                    Image::create([
                        'image_path' => 'images/gallary/1694375023_tech.png',
                        'imageable_type' => Article::class,
                        'imageable_id' => $article6->id,
                    ]);




            $article7 =  Article::create([

                'article_cover' => 'images/gallary/1694375023_tech.png',

                'category' => 'Sport Events',

                'title_en'   => 'title7' ,

                'title_ar'   => 'عنوان7' ,

                'sub_title_en'   => 'sub title7',

                'sub_title_ar'   => '7عنوان فرعي ',

                'content_en'  => 'Lorem Ipsum giving information on its origins as well as'  ,

                'content_ar'  => 'طريقة لكتابة النصوص في النشر والتصميم الجرافيكي تستخدم بشكل شائع'  ,

                'date' => Carbon::parse('2023-09-09'),

            ]);
                Image::create([
                    'image_path' => 'images/gallary/1694375023_tech.png',
                    'imageable_type' => Article::class,
                    'imageable_id' => $article7->id,
                ]);
    }
}

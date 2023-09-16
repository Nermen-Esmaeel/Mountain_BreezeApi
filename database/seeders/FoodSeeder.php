<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Food;

class FoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Food::create([

            'image' => 'images/galary/1694375023_tech.png',

            'category' => 'Westren Food',

            'title_en'   => 'title1' ,

            'title_ar'   => 'عنوان1' ,

            'content_en'  => 'Lorem Ipsum giving information on its origins as well as'  ,

            'content_ar'  => 'طريقة لكتابة النصوص في النشر والتصميم الجرافيكي تستخدم بشكل شائع'  ,


        ]);


        Food::create([

            'image' => 'images/galary/1694375023_tech.png',

            'category' => 'Oriental Food',

            'title_en'   => 'title1' ,

            'title_ar'   => 'عنوان1',

            'content_en'  => 'Lorem Ipsum giving information on its origins as well as'  ,

            'content_ar'  => 'طريقة لكتابة النصوص في النشر والتصميم الجرافيكي تستخدم بشكل شائع'  ,


        ]);


        Food::create([

            'image' => 'images/galary/1694375023_tech.png',

            'category' => 'Traditional Food',


            'title_en'   => 'title1' ,

            'title_ar'   => 'عنوان1' ,

            'content_en'  => 'Lorem Ipsum giving information on its origins as well as'  ,

            'content_ar'  => 'طريقة لكتابة النصوص في النشر والتصميم الجرافيكي تستخدم بشكل شائع'  ,


        ]);
    }
}

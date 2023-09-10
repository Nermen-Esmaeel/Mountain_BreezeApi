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

            'category_en' => 'Westren Food',

            'category_ar' => 'غربي',

            'title_en'   => 'title1' ,

            'title_ar'   => 'عنوان1' ,

            'content_en'  => 'Lorem Ipsum giving information on its origins as well as'  ,

            'content_ar'  => 'طريقة لكتابة النصوص في النشر والتصميم الجرافيكي تستخدم بشكل شائع'  ,


        ]);
    }
}

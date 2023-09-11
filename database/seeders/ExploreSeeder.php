<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Explore;

class ExploreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Explore::create([
            'article_cover' =>  'images/galary/1694375023_tech.png',
            'tags' =>  'Nature',
            'title_en' => 'english title',
            'title_ar' =>  'العنوان ',
            'content_en' =>  'Newly refurnished luxury accommodation with finest quality linen & quality decor. Air conditioning Electric Blankets, Ironing Boards, Mini Bar, Flat Screen & Free in house Movies, WiFi and HouseKeeping by request.',
            'content_ar' => 'أماكن إقامة فاخرة تم تجديدها حديثًا مع مفروشات عالية الجودة وديكور عالي الجودة. تكييف الهواء بطانيات كهربائية وطاولات كي الملابس وميني بار وشاشة مسطحة وأفلام داخلية مجانية وخدمة الواي فاي وخدمة تنظيف الغرف حسب الطلب',
            'date' => '2023-09-07',
        ]);
    }
}

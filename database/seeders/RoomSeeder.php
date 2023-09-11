<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Image;
use App\Models\Room;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $room = Room::create([
            'name_en' => 'Duplex Room',
            'name_ar' => 'غرفة مزدوجة',
            'type' => 'VIP',
            'guests_number' => '3',
            'price' => '90',
            'content_en' => 'Newly refurnished luxury accommodation with finest quality linen & quality decor. Air conditioning Electric Blankets, Ironing Boards, Mini Bar, Flat Screen & Free in house Movies, WiFi and HouseKeeping by request.',
            'content_ar' => 'أماكن إقامة فاخرة تم تجديدها حديثًا مع مفروشات عالية الجودة وديكور عالي الجودة. تكييف الهواء بطانيات كهربائية وطاولات كي الملابس وميني بار وشاشة مسطحة وأفلام داخلية مجانية وخدمة الواي فاي وخدمة تنظيف الغرف حسب الطلب',
            'floor' => '2',
            'room_services' => 1,
            'bed' => 1,
            'TV' => 1
        ]);
        Image::create([
            'image_path' => 'images/galary/1694375023_tech.png',
            'imageable_type' => Room::class,
            'imageable_id' => $room->id,
        ]);
    }
}

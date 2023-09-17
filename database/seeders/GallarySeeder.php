<?php

namespace Database\Seeders;

use App\Models\Gallary;
use App\Models\Image;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GallarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $gallary = Gallary::create([
            'type' => 'Events',
        ]);

        Image::create([
            'image_path' => 'images/gallary/1694375023_tech.png',
            'imageable_type' => Gallary::class,
            'imageable_id' => $gallary->id,
        ]);
        $gallary1 = Gallary::create([
            'type' => 'Nature',
        ]);

        Image::create([
            'image_path' => 'images/gallary/1694375023_tech.png',
            'imageable_type' => Gallary::class,
            'imageable_id' => $gallary1->id,
        ]);
        $gallary2 = Gallary::create([
            'type' => 'Activity',
        ]);

        Image::create([
            'image_path' => 'images/gallary/1694375023_tech.png',
            'imageable_type' => Gallary::class,
            'imageable_id' => $gallary2->id,
        ]);
        $gallary3 = Gallary::create([
            'type' => 'Chalet',
        ]);

        Image::create([
            'image_path' => 'images/gallary/1694375023_tech.png',
            'imageable_type' => Gallary::class,
            'imageable_id' => $gallary3->id,
        ]);
        $gallary4 = Gallary::create([
            'type' => 'Restaurant',
        ]);

        Image::create([
            'image_path' => 'images/gallary/1694375023_tech.png',
            'imageable_type' => Gallary::class,
            'imageable_id' => $gallary4->id,
        ]);
    }
}

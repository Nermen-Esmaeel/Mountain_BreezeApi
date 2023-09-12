<?php

namespace Database\Seeders;

use App\Models\Galary;
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
        $galary = Galary::create([
            'type' => 'Events',
        ]);

        Image::create([
            'image_path' => 'images/galary/1694375023_tech.png',
            'imageable_type' => Galary::class,
            'imageable_id' => $galary->id,
        ]);
        $galary1 = Galary::create([
            'type' => 'Nature',
        ]);

        Image::create([
            'image_path' => 'images/galary/1694375023_tech.png',
            'imageable_type' => Galary::class,
            'imageable_id' => $galary1->id,
        ]);
        $galary2 = Galary::create([
            'type' => 'Activity',
        ]);

        Image::create([
            'image_path' => 'images/galary/1694375023_tech.png',
            'imageable_type' => Galary::class,
            'imageable_id' => $galary2->id,
        ]);
        $galary3 = Galary::create([
            'type' => 'Chalet',
        ]);

        Image::create([
            'image_path' => 'images/galary/1694375023_tech.png',
            'imageable_type' => Galary::class,
            'imageable_id' => $galary3->id,
        ]);
        $galary4 = Galary::create([
            'type' => 'Restaurant',
        ]);

        Image::create([
            'image_path' => 'images/galary/1694375023_tech.png',
            'imageable_type' => Galary::class,
            'imageable_id' => $galary4->id,
        ]);
    }
}

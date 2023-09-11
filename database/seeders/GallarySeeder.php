<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Galary;
use App\Models\Image;

class GallarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $galary = Galary::create([
            'type' => 'Restaurant',
        ]);

        Image::create([
            'image_path' => 'images/galary/1694375023_tech.png',
            'imageable_type' => Galary::class,
            'imageable_id' => $galary->id,
        ]);
    }
}

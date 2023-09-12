<?php

namespace Database\Seeders;

use App\Models\Video;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Video::create([
            'type' => 'Events',
            'name' => 'video name',
            'link' => 'https://www.youtube.com/watch?v=jffKw_NMfnw'
        ]);
        Video::create([
            'type' => 'Nature',
            'name' => 'video name',
            'link' => 'https://www.youtube.com/watch?v=jffKw_NMfnw'
        ]);
        Video::create([
            'type' => 'Activity',
            'name' => 'video name',
            'link' => 'https://www.youtube.com/watch?v=jffKw_NMfnw'
        ]);
        Video::create([
            'type' => 'Chalet',
            'name' => 'video name',
            'link' => 'https://www.youtube.com/watch?v=jffKw_NMfnw'
        ]);
        Video::create([
            'type' => 'Restaurant',
            'name' => 'video name',
            'link' => 'https://www.youtube.com/watch?v=jffKw_NMfnw'
        ]);
        Video::create([
            'type' => 'Chalet',
            'name' => 'video name',
            'link' => 'https://www.youtube.com/watch?v=jffKw_NMfnw'
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Video;

class VideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Video::create([
            'type' => 'Chalet',
            'name' => 'video name',
            'link' => 'https://www.youtube.com/watch?v=jffKw_NMfnw'
        ]);
    }
}

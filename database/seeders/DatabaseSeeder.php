<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {



        User::create([
            'id' => 1,
            'name' => 'Super Admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);


        for ($i = 0; $i < 7; $i++){
            $this->call([
                BookSeeder::class,
                Contact_asSeeder::class,
                FoodSeeder::class,
                BlogSeeder::class,
                RoomSeeder::class,
                GallarySeeder::class,
                VideoSeeder::class,
                ExploreSeeder::class,
            ]);
        }
        $this->call(TagSeeder::class);


    }
}

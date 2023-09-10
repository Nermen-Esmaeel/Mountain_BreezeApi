<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


use App\Models\Message;

class Contact_asSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Message::create([

            'full_name' => 'Nermen',

            'phone' => '1234567889',

            'email' => 'nermen@gmail.com',

            'subject' => 'Lorem Ipsum' ,

            'content'  => 'Lorem Ipsum giving information on its origins as well as'  ,


        ]);
    }
}
